@extends('layouts.account')

@section('account.title')
    <h2 class="text-center block-title">
        {{ trans('titles.account.sub_accounts') }}
    </h2>
@endsection

@section('before_content')
    <!-- Add user modal -->
    @include('components.account.sub_accounts.addModal')

    <!-- Edit user modal -->
    @include('components.account.sub_accounts.editModal')
@endsection

@section('account.content')
    <button data-target="#addAccountDialog" data-toggle="modal" class="btn btn-success btn-block btn-lg">Nieuw account aanmaken</button>

    <hr />

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Gebruikersnaam</th>
            <th>Email</th>
            <th>Rol</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($accounts as $account)
            <tr>
                <td>{{ $account->getUsername() }} <small>{{ $account->getUsername() === auth()->user()->getUsername() ? '[Huidig account]' : '' }}</small></td>
                <td>{{ $account->getEmail() }}</td>

                <td>
                    <div class="fa fa-spinner fa-spin" style="display: none;"></div>

                    <select name="role" class="form-control">
                        @if (auth()->isAdmin())
                            <option value="admin" {{ $account->getRole() === 'admin' ? 'selected' : '' }}>Admin</option>
                        @endif
                        @if (auth()->isManager())
                            <option value="manager" {{ $account->getRole() === 'manager' ? 'selected' : '' }}>Manager</option>
                        @endif

                        <option value="user" {{ $account->getRole() === 'user' ? 'selected' : '' }}>Gebruiker</option>
                    </select>
                    {{--<input data-user="{{ $account }}" type="checkbox" name="manager"--}}
                           {{--data-url="{{ route('customer.accounts::update', ['id' => $account->getId()]) }}"--}}
                           {{--onchange="updateManager(this)" {{ $account->isManager() ? 'checked' : '' }}>--}}
                </td>
                <td>
                    <button data-username="{{ $account->getUsername() }}"
                            class="btn btn-danger deleteUserButton"><i class="fa fa-fw fa-trash-o"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('extraJS')
    @include('components.account.sub_accounts.javascript')
@endsection