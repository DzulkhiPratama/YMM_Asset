<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">

            @auth
            <!-- jika sudah login -->
            <li class="nav-item">
                <a class="nav-link <?= ($tittle === "Dashboard") ? 'active' : '' ?>" aria-current="page" href="/dashboard">
                    <span data-feather="home"></span>
                    YMM Assets
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($tittle === "Transaction") ? 'active' : '' ?>" href="/transaction">
                    <span data-feather="layers"></span>
                    Approval & Order List
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($tittle === "Order") ? 'active' : '' ?>" href="/order">
                    <span data-feather="file-text"></span>
                    Your Order
                </a>
            </li>

            @if ( auth()->user()->role_id >= 2)
            <li class="nav-item">
                <a class="nav-link <?= ($tittle === "admin") ? 'active' : '' ?>" href="/admin">
                    <span data-feather="users"></span>
                    User Admin
                </a>
            </li>
            @endif

            @else
            <!-- jika belum log in -->
            <li class="nav-item">
                <a class="nav-link <?= ($tittle === "Dashboard") ? 'active' : '' ?>" aria-current="page" href="/">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>


            @endauth

        </ul>


    </div>
</nav>