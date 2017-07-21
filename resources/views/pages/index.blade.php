@extends('layouts.home')

@section('content')

    @if( request()->is('/') )
        <div class="container">
            <div class="well well-sm text-center ie-only">
                <h4>Voor de beste ervaring met onze website raden wij een moderne browser aan, zoals: <a href="https://www.google.com/chrome/browser/desktop/index.html" target="_blank">Google Chrome</a> of <a href="https://www.mozilla.org/nl/firefox/new/" target="_blank">Firefox</a>.</h4>
            </div>
        </div>
    @endif

    <h2 class="text-center block-title" id="news">Nieuws</h2>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @block('news')
            </div>
        </div>
    </div>

    <hr />

    <h2 class="text-center block-title" id="contact">Contact</h2>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('components.contact')
            </div>
        </div>
    </div>

    <div style="height: 500px; background: url({{ asset('img/about-header.jpg') }}) bottom; background-size: cover;"></div>

    <h2 class="text-center block-title" id="about">Over ons</h2>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @block('about')
            </div>
        </div>
    </div>

    <hr />

    <h2 class="text-center block-title">Vestiging</h2>

    @include('components.maps')
@endsection
