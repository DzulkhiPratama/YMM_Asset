<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand" href="#">YMM PT FI</a>

    <button class="navbar-toggler position-absolute px-0 d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            @auth
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="nav-link px-5 border-0" style=" background-color: transparent">
                    <!-- sudah ada relasi db antara auth dengan model user bawaan laravel -->
                    {{ auth()->user()->name }} <i class="bi bi-box-arrow-in-right"></i>
                </button>
            </form>


            @else
            <a class="nav-link px-5" href="/login">Sign In <i class="bi bi-box-arrow-in-left"></i></a>

            @endauth

        </div>
    </div>

</header>