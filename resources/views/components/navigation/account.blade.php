<div class="list-group">
    <a href="{{ routeIf('account.dashboard') }}"
       class="list-group-item {{ Route::is('account.dashboard') ? 'active' : '' }}">
        Overzicht
    </a>
    @if (auth()->isManager())
        <a href="{{ routeIf('account.sub_accounts') }}"
           class="list-group-item {{ Route::is('account.sub_accounts') ? 'active' : '' }}">
            Sub-accounts
        </a>
    @endif
    <a href="{{ routeIf('account.change_password') }}"
       class="list-group-item {{ Route::is('account.change_password') ? 'active' : '' }}">
        Wachtwoord wijzigen
    </a>
    <a href="{{ routeIf('account.favorites') }}"
       class="list-group-item {{ Route::is('account.favorites') ? 'active' : '' }}">
        Favorieten
    </a>
    <a href="{{ routeIf('account.history') }}"
       class="list-group-item {{ Route::is('account.history') ? 'active' : '' }}">
        Bestelgeschiedenis
    </a>
    <a href="{{ routeIf('account.addresses') }}"
       class="list-group-item {{ Route::is('account.addresses') ? 'active' : '' }}">
        Adressenlijst
    </a>
    <a href="{{ routeIf('account.discountfile') }}"
       class="list-group-item {{ Route::is('account.discountfile') ? 'active' : '' }}">
        Kortingsbestand genereren
    </a>
</div>
