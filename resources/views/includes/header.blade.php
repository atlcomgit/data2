<header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand {{ active_link('home') }}" href="{{ route('home') }}">{{ __('Главная') }}</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ active_link('module*') }}" href="{{ route('modules') }}">{{ __('Модули') }}</a>
                    </li>

                    {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li> --}}

                    {{-- <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li> --}}
                </ul>

                {{-- <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> --}}

                <ul class="navbar-nav -me-auto mb-2 mb-lg-0">
                    @auth
                        <li class='nav-item'>
                            <a class="nav-link {{ active_link('module*') }}" href="{{ route('modules') }}">{{ __('Выход') }}</a>
                        </li>
                    @else
                        <li class='nav-item'>
                            <a class="nav-link {{ active_link('login*') }}" href="{{ route('login') }}">{{ __('Вход') }}</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

</header>
