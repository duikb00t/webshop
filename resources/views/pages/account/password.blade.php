@extends('layouts.account')

@section('account.title')
    <h2 class="text-center block-title">
        {{ trans('titles.account.change_password') }}
    </h2>
@endsection

@section('account.content')
    <form method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="password_old" class="col-sm-4 control-label">Huidig wachtwoord</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="password_old" placeholder="Huidig wachtwoord" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-4 control-label">Nieuw wachtwoord</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="password" placeholder="Nieuw wachtwoord" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="col-sm-4 control-label">Nieuw wachtwoord (bevestiging)</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Nieuw wachtwoord (bevestiging)" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary pull-right">Wijzigen</button>
    </form>
@endsection
