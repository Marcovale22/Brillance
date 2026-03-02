
@section('navBar')
<nav class="navbar navbar-expand-xl bg-white  py-5">
    <div class="container-fluid">

        {{-- LOGO CENTRALE (VISIBILE SOLO SU DESKTOP) --}}
        

        {{-- Mobile hamburger --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar" aria-controls="mainNavbar"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- CONTENUTO COLLASSABILE --}}
        <div class="collapse navbar-collapse" id="mainNavbar">

            {{-- SEZIONE SINISTRA (DESKTOP) --}}
            @php
                $home = route('home');
                $isHome = request()->routeIs('home');
                $anchor = fn($id) => $isHome ? "#$id" : $home."#$id";
            @endphp

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-left">
                <li class="nav-item">
                    <a class="nav-link" href="{{ $anchor('servizi') }}">Servizi</a>
                </li> 

                <li class="nav-item">
                    <a class="nav-link" href="{{ $anchor('unisciti') }}">Unisciti a noi</a>
                </li>      
            </ul>

           


            <a class="navbar-brand position-absolute start-50 translate-middle-x d-none d-lg-block fw-bold fs-3" href="{{ route('home') }}">
                <img src="{{ asset('img/logo_brillance.png') }}" alt="Logo Bellò" class="logo-navbar">
            </a>

        </div>
    </div>
</nav>



@endsection