@extends('base')

@section('title', config('app.name') . ' - Homepage')

@section('content')
<div class="main">
    <div class="homepage">
        <div class="hero-content">
            <h1>Pulizie Professionali</h1>
            <p>Condomini e Aziende sempre perfetti</p>
            <a href="#contatti" class="home-btn">Contattaci</a>
        </div>
    </div>

    <div class="home-servizi">

        <h2 class="title-home">I nostri servizi</h2>

        <div class="servizi-grid">

            <div class="servizio-card card-condomini">
                <div class="overlay"></div>
                <h3>Condomini</h3>
            </div>

            <div class="servizio-card card-aziende">
                <div class="overlay"></div>
                <h3>Aziende e Uffici</h3>
            </div>

            <div class="servizio-card card-aziende">
                <div class="overlay"></div>
                <h3>Negozi</h3>
            </div>

        </div>

    </div>

    <div class="home-chiSiamo">
        <h1 style="color: white; text-align: center; padding-top: 100px; font-size: 42px; font-weight: 700;">Chi siamo</h1>
    </div>

    <div class="home-unisciti">
        <h1 style="color: white; text-align: center; padding-top: 100px; font-size: 42px; font-weight: 700;">Unisciti a noi</h1>

    </div>

</div>

@endsection