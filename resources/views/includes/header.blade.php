<header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            @auth('web')
                <a class="navbar-brand me-0 {{ active_link('module','navbar-brand-disabled') }}" href="{{ route('pages.modules') }}">{{ __('Модули') }}</a>
            @else
                <a class="navbar-brand {{ active_link('/','navbar-brand-disabled') }}" href="{{ route('pages.home') }}">{{ __('Главная') }}</a>
            @endauth

            @yield('module')

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth('web')
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ active_link('module*') }}" href="{{ route('pages.modules') }}">{{ __('Модули') }}</a>
                        </li> --}}
                        @endauth
                </ul>
                
                <ul class="navbar-nav -me-auto mb-2 mb-lg-0">
                    @auth('web')
                        <li class='nav-item'>
                            <a class="nav-link" href="{{ route('pages.auth.logout') }}">{{ __('Выход') }}</a>
                        </li>
                    @else
                        <li class='nav-item'>
                            <a class="nav-link {{ active_link('login*') }}" href="{{ route('pages.auth.login') }}">{{ __('Вход') }}</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

</header>
