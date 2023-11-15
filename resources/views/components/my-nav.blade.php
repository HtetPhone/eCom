<div class="w-100 shadow-sm">
    <div class="container py-2">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid align-items-end ">
                <a class="navbar-brand" href="{{ route('page.index') }}">eCom</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0 me-3">
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Categories
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach (App\Models\Category::all() as $cat)
                                        <li><a class="dropdown-item"
                                                href="{{ route('categorize', ['category' => $cat->name]) }}">
                                                {{ $cat->name }} </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>

                    <!-- search -->
                    <form class="d-flex" method="GET" action="{{ route('search') }}" role="search"
                        style="width: 50%;">
                        <input class="form-control me-2" name="search" type="search" placeholder="Search"
                            aria-label="Search">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </form>

                    <div class="ms-auto d-flex align-items-center">
                        <a href="{{ route('checkout') }}" class="btn btn-sm btn-outline-dark position-relative">
                            <i class="bi bi-cart"></i>
                            @auth
                                @if (App\Models\Cart::where('user_id', auth()->id())->get()->count() > 0)
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ App\Models\Cart::where('user_id', auth()->id())->get()->count() }}
                                    </span>
                                @endif
                            @endauth
                        </a>

                        @guest
                            <div class="d-flex ms-2 align-items-center">
                                <a href="{{ route('login') }}" class="btn btn-info btn-sm">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-warning btn-sm ms-2">Register</a>
                            </div>
                        @endguest

                        @auth
                            <div class="dropdown ms-2">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                    @if (auth()->user()->role === 'admin')
                                        <li><a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a></li>
                                    @endif
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <input class="btn w-100 ps-3 text-start " type="submit" value="Logout">
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
