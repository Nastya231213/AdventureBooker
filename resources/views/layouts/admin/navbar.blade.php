<nav class="navbar navbar-expand-lg  ">
    <div class="container-fluid py-3 px-5">
        <a class="navbar-brand" href="#"><i class="bi bi-gear-fill"></i> Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item d-flex  align-items-center">
                    <i class="bi bi-speedometer2"></i>
                    <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{route('admin.dashboard')}}">Dashboard</a>
                </li>
                <li class="nav-item d-flex  align-items-center">
                    <i class="bi bi-person-fill"></i>
                    <a class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}" href="#">Users</a>
                </li>

                <li class="nav-item d-flex  align-items-center">
                    <i class="bi bi-box-arrow-right me-2"></i>

                    <a href="#" class="nav-link" onlick="event.preventDefault(); document.getElementById('logout-form').submit()">
                        Logout
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>