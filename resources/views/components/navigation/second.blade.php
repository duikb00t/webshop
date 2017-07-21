<nav class="navbar navbar-default navbar-static-top" id="navbar-second">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbar-links">
            <ul class="nav navbar-nav">
                <li class="{{ Route::is('home') ? 'active' :'' }}">
                    <a href="{{ routeIf('home') }}">{{ trans('navigation.items.home') }}</a>
                </li>
                <li class="{{ Route::is('downloads') ? 'active' : '' }}">
                    <a href="{{ routeIf('downloads') }}">{{ trans('navigation.items.downloads') }}</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ trans('navigation.items.webshop') }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ routeIf('catalog::assortment.index') }}">{{ trans('navigation.items.assortment') }}</a></li>
                        <li><a href="{{ routeIf('search') }}">{{ trans('navigation.items.search') }}</a></li>
                        <li><a href="{{ routeIf('catalog::assortment.deals') }}">{{ trans('navigation.items.deals') }}</a></li>
                        <li><a href="{{ routeIf('sales') }}">{{ trans('navigation.items.sales') }}</a></li>
                    </ul>
                </li>
                @if(auth()->isAdmin())
                    <li><a href="{{ routeIf('admin::dashboard') }}">{{ trans('navigation.items.admin') }}</a></li>
                @endif
            </ul>

            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    @if(auth()->check())
                        <li class="{{ request()->is('cart') ? 'active' : '' }}">
                            <a href="{{ routeIf('checkout::cart.index') }}" style="height: 50px">
                                {{ trans('navigation.items.cart') }} <span class="badge" id="cart-badge">{{ $quote->getItemCount() }}</span>
                            </a>
                        </li>
                        <li class="dropdown {{ request()->is('account/*') ? 'active' : '' }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('navigation.items.account') }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ routeIf('account.dashboard') }}"><span class="glyphicon glyphicon-user"></span> {{ trans('navigation.items.dashboard') }}</a></li>
                                <li><a href="{{ routeIf('account.favorites::view') }}"><span class="glyphicon glyphicon-heart"></span> {{ trans('navigation.items.favorites') }}</a></li>
                                <li><a href="{{ routeIf('account.history::view') }}"><span class="glyphicon glyphicon-time"></span> {{ trans('navigation.items.order_history') }}</a></li>
                                <li><a href="{{ routeIf('account.discountfile::view') }}"><span class="glyphicon glyphicon-euro"></span> {{ trans('navigation.items.discount_file') }}</a></li>
                                <li class="divider"></li>
                                <li><a href="#" onclick="document.getElementById('logout-form').submit()"><span class="glyphicon glyphicon-off"></span> {{ trans('navigation.items.logout') }}</a></li>
                            </ul>
                        </li>

                        <form class="hidden" action="{{ routeIf('auth.logout') }}" method="post" id="logout-form">
                            {{ csrf_field() }}
                        </form>
                    @else
                        <li><a class="register-button" href="{{ routeIf('auth.register.form') }}">{{ trans('navigation.items.register') }}</a></li>
                        <li><a href="{{ routeIf('auth.login', ['toUrl' => url()->current()]) }}">{{ trans('navigation.items.login') }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>