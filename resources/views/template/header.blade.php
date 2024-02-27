<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <span class="fs-4 fw-bold">api4devs</span>
    </a>

    <ul class="nav navbar-light bg-light">
        <li class="nav-item"><a href="/" class="nav-link" aria-current="page">Início</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Atualizações</a></li>
        <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Sobre</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Contribuir</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Contato</a></li>

        @if (Auth::check())
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                <li class="nav-item">
                    <a class="nav-link" href="#">Olá, {{ Auth::user()->name }}</a>
                </li>
            </button>
            <ul class="dropdown-menu">
                <li class="nav-item">
                    <a class="nav-link" href="#">Configurações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Meus Links</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('auth.login.view') }}">Login</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('auth.register.view') }}">Register</a>
            </li>
        @endif
    </ul>
</header>

{{-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="/">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="/user/config">Olá, {{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/links/user">Links User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                @else
                    <!-- Link para a página de login -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    <!-- Link para a página de registro -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav> --}}
