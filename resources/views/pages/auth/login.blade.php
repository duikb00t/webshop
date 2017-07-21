@extends('layouts.main')

@section('content')
    <h2 class="text-center block-title" id="login">Login</h2>

    <hr />

    <div class="container">
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <form method="POST" class="form form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Debiteurnummer</label>
                        <div class="col-sm-8">
                            <input type="text" name="company" class="form-control" placeholder="Debiteurnummer" autocomplete="off" required value="{{ old('company') }}">
                            <p class="help-block">Bijv. 12345</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="account" class="col-sm-4 control-label">Gebruikersnaam</label>
                        <div class="col-sm-8">
                            <input type="text" name="username" class="form-control" placeholder="Gebruikersnaam" autocomplete="off" required value="{{ old('username') }}">
                            <p class="help-block">Bijv. "Piet"</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">Wachtwoord</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" class="form-control" placeholder="Wachtwoord" aria-describedby="forgotPassword" required>
                            <span id="forgotPassword" class="help-block"><a href="{{ routeIf('auth.password.email') }}">Wachtwoord vergeten?</a></span>
                        </div>
                    </div>

                    <div class="checkbox">
                        <div class="col-sm-offset-4 col-sm-8">
                            <label>
                                <input name="remember" type="checkbox"> Ingelogd blijven?
                            </label>
                        </div>
                    </div>

                    <br />

                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-lg btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection