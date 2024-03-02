{{-- <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
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
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('view.auth.login') }}">Login</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('view.auth.register') }}">Register</a>
            </li>
        @endif
    </ul>
</header> --}}

<nav class="navbar navbar-expand-lg bg-light" aria-label="Light offcanvas navbar">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">api4devs</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarLight"
            aria-controls="offcanvasNavbarLight">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarLight"
            aria-labelledby="offcanvasNavbarLightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLightLabel">Offcanvas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex mt-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</nav>
