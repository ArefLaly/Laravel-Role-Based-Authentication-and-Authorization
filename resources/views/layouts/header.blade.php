<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap" />
                </svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('home') }}" class="nav-link px-2 link-dark">Home</a></li>
                <li><a href="{{ route('user.index') }}" class="nav-link px-2 link-dark">Users</a></li>
                <li><a href="{{ route('role.index') }}" class="nav-link px-2 link-dark">Roles</a></li>
            </ul>
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        
                        <img src="{{ asset(Auth::user()->photo) }}" alt="Arif Laly" width="32" height="32"
                            class="rounded-circle">
                            {{ Auth::user()->fullname }}
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="{{route('user.profile')  }}">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route("logout") }}" class="user-logout-form">@csrf
                                <button class="dropdown-item" href="{{ route('logout') }}">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            
        </div>
    </div>
</header>
