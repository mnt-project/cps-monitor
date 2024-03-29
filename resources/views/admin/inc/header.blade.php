<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href={{ route('home') }}>CPSadmin [ {{ auth()->user()->login }} ] IP:[ {{ Request::ip() }} ]</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_navbar" aria-controls="main_navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_navbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href={{ route('home') }}>Home</a>
                </li>
                @isadmin(Illuminate\Support\Facades\Auth::user())
                <li class="nav-item me-4">
                    <a class="nav-link border border-danger" href="{{ route('home')}}">Exit</a>
                </li>
                @endisadmin
                <li class="nav-item">
                    <x-login-button status="{{ Illuminate\Support\Facades\Auth::check() }}"></x-login-button>
                </li>
            </ul>
        </div>
    </div>
</nav>
