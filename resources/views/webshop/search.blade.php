@extends('master')

@section('title')
        <h3>Zoeken</h3>
@stop

@section('content')
        <div class="alert alert-success" role="alert">
                {{ $results->total() }} resultaten gevonden in {{ $scriptTime }} seconden.
        </div>
        <div class="panel panel-default">
                <div class="panel-heading">
                        <h4 class="panel-title text-center">
                                Geavanceerd zoeken
                        </h4>
                </div>
                <div class="panel-body">
                        <form action="/search" method="GET" role="search" class="form-horizontal" name="advancedsearch" id="searchForm">
                                <div class="row">
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                        <label class="col-sm-2 control-label">Merk</label>
                                                        <div class="col-sm-10">
                                                                <select onchange="window.history.go(-1);" name="brand" class="form-control">
                                                                        <option value="">----------</option>
                                                                        @foreach($brands as $brand)
                                                                                <option @if(Input::get('brand') === $brand) selected @endif value="{{ $brand }}">{{ $brand }}</option>
                                                                        @endforeach
                                                                </select>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                        <label class="col-sm-2 control-label">Serie</label>
                                                        <div class="col-sm-10">
                                                                <select onchange="window.history.go(-1);" name="serie" class="form-control">
                                                                        <option value="">----------</option>
                                                                        @foreach($series as $serie)
                                                                                <option @if(Input::get('serie') === $serie) selected @endif value="{{ $serie }}">{{ $serie }}</option>
                                                                        @endforeach
                                                                </select>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                        <label class="col-sm-2 control-label">Type</label>
                                                        <div class="col-sm-10">
                                                                <select onchange="window.history.go(-1);" name="type" class="form-control">
                                                                        <option value="">----------</option>
                                                                        @foreach($types as $type)
                                                                                <option @if(Input::get('type') === $type) selected @endif value="{{ $type }}">{{ $type }}</option>
                                                                        @endforeach
                                                                </select>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <input name="q" type="hidden" value="{{ Input::get('q') }}">
                        </form>

                        <div class="row">
                                <div class="col-md-6">
                                        <button onclick="window.history.go(-1);" class="btn btn-default btn-block"><span class="glyphicon glyphicon-chevron-left"></span> Terug naar vorige pagina</button>
                                </div>
                                <div class="col-md-6">
                                        <button class="btn btn-primary pull-right btn-block" onclick="wtg.quickSearch();">Zoeken</button>
                                </div>
                        </div>                        

                        <!-- Hidden on load, will show after a dropdown option has changed -->
                        <div class="row text-center" id="searchLoading" style="display: none;">
                                <img src="/img/loading.gif" width="70px">
                        </div>
                </div>
        </div>


        <table class="table table-striped">
                <thead>
                        <tr>
                                <th></th>
                                <th>Artikelnummer</th>
                                <th>Omschrijving</th>
                                @if(Auth::check())
                                        <th>Bruto prijs</th>
                                        <th>Korting</th>
                                        <th>Netto prijs</th>
                                @endif
                        </tr>
                </thead>
                <tbody>
                        <?php $discounts = (Auth::check() ? getProductDiscount(Auth::user()->login) : ''); ?>
                        @foreach($results as $product)
                                <?php $price = number_format((preg_replace("/\,/", ".", $product->price) * $product->refactor) / $product->price_per, 2, ".", ""); ?>

                                @if(isset($discounts[$product->number]))
                                        <?php $discount = $discounts[$product->number]; ?>
                                @elseif(isset($discounts[$product->group]))
                                        <?php $discount = $discounts[$product->group]; ?>
                                @else
                                        <?php $discount = 0; ?>
                                @endif

                                <tr>
                                        <td class="product-thumbnail"><img src="/img/product/{{ $product->image }}" alt="{{ $product->image }}"></td>
                                        <td>{{ $product->number }}</td>
                                        <td><a href="/product/{{ $product->number }}">{{ $product->name }}</a></td>
                                        @if(Auth::check())
                                                <td>&euro;{{ $price }}</td>
                                                <td>{{ $discount }}%</td>
                                                <td>&euro;{{ number_format($price * ((100-$discount) / 100), 2, ".", "") }}</td>
                                        @endif
                                </tr>
                        @endforeach
                </tbody>
        </table>

        <div class="text-center">
                {!! $results->appends(array('brand' => Input::get('brand'), 'serie' => Input::get('serie'), 'type' => Input::get('type'), 'q' => Input::get('q')))->render() !!}
        </div>
@stop

@section('extraJS')
        <script type="text/javascript">
                var wtg = {
                        quickSearch : function() {
                                document.advancedsearch.submit();
                        }
                }
        </script>
@stop