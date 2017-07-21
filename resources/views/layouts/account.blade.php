@extends('layouts.main')

@section('content')
    @yield('account.title')

    <hr />

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('components.navigation.account')
            </div>

            <div class="col-sm-9">
                @yield('account.content')
            </div>
        </div>
    </div>
@endsection