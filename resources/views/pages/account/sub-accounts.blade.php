@extends('layouts.account')

@section('account.title')
    <h2 class="text-center block-title">
        {{ trans('titles.account.sub-accounts') }}
    </h2>
@endsection

@section('before_content')
    <!-- Add user modal -->
    @include('components.account.sub-accounts.addModal')

    <!-- Delete user modal -->
    @include('components.account.sub-accounts.deleteModal')
@endsection

@section('account.content')
    <button data-target="#addAccountDialog" data-toggle="modal" class="btn btn-success btn-block btn-lg">Nieuw account aanmaken</button>

    <hr />

    <p class="alert alert-info">
        Bent u het wachtwoord vergeten van een account? <br/>
        Geen probleem, U kunt eenvoudig een "wachtwoord vergeten" mail versturen naar het gekoppelde email adres door op
        het <i class="fa fa-key" aria-hidden="true"></i> icoontje te klikken achter aan de regel.
    </p>

    <hr />

    <div class="row sub-account-header">
        <div class="col-sm-4">
            <b>Gebruikersnaam</b>
        </div>
        <div class="col-sm-4">
            <b>E-Mail</b>
        </div>
        <div class="col-sm-4">
            <b>Rol</b>
        </div>
    </div>

    @foreach($accounts as $account)
        @php
            $current = $account->getUsername() === auth()->user()->getUsername();
        @endphp

        <div class="row sub-account {{ $current ? 'current-account' : '' }}">
            <div class="col-sm-4 sub-account-username">
                {{ $account->getUsername() }}
            </div>
            <div class="col-sm-4 sub-account-email">
                {{ $account->getEmail() }}
            </div>
            <div class="col-sm-2 sub-account-role">
                <div class="fa fa-spinner fa-spin" style="display: none;"></div>

                <select class="form-control" data-user="{{ $account->getId() }}"
                        autocomplete="off" {{ $current ? 'disabled' : '' }} onchange="updateRole(this)">
                    @if (auth()->isAdmin())
                        <option value="admin" {{ $account->getRole() === 'admin' ? 'selected' : '' }}>Admin</option>
                    @endif

                    @if (auth()->isManager())
                        <option value="manager" {{ $account->getRole() === 'manager' ? 'selected' : '' }}>Manager</option>
                    @endif

                    <option value="user" {{ $account->getRole() === 'user' ? 'selected' : '' }}>Gebruiker</option>
                </select>
            </div>
            <div class="col-sm-2 sub-account-actions">
                @if (!$current)
                    <a href="#" title="Verstuur 'wachtwoord vergeten' mail naar {{ $account->getEmail() }}"
                       class="btn btn-link" data-email="{{ $account->getEmail() }}"><i class="fa fa-fw fa-key"></i>
                    </a>

                    <a href="#" data-username="{{ $account->getUsername() }}"
                       class="btn btn-link icon-danger edit-user"><i class="fa fa-fw fa-trash-o"></i>
                    </a>
                @endif
            </div>
        </div>
    @endforeach
@endsection

@section('extraJS')
    @include('components.account.sub-accounts.javascript')
@endsection