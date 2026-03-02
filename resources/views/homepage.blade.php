@extends('base')

@section('title', config('app.name') . ' - Homepage')

@section('content')
<div class="main">
    <div class="homepage">
        <div class="hero-content">
            <h1>Pulizie Professionali</h1>
            <p>Condomini e Aziende sempre perfetti</p>
            
            <div class="contact-info">
                <a href="tel:+393331234567" class="contact-item">
                    <i class="fas fa-phone"></i>
                    <span>329 288 9300</span>
                </a>

                <a href="mailto:mihaelahanganu88@gmail.com" class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>mihaelahanganu88@gmail.com</span>
                </a>
            </div>
        </div>
    </div>

    <div id="servizi" class="home-servizi">

        <h2 class="title-home">I nostri servizi</h2>

        <div class="servizi-grid">

            <a href="{{ route('servizi') }}" class="servizio-card card-condomini">
                <div class="overlay"></div>
                <h3>Condomini</h3>
            </a>

            <a href="{{ route('servizi') }}" class="servizio-card card-aziende">
                <div class="overlay"></div>
                <h3>Aziende e Uffici</h3>
            </a>

            <a href="{{ route('servizi') }}" class="servizio-card card-negozio">
                <div class="overlay"></div>
                <h3>Negozi</h3>
            </a>

        </div>

    </div>
{{-- 
    <div class="home-chiSiamo">
        <h1 style="color: white; text-align: center; padding-top: 100px; font-size: 42px; font-weight: 700;">Chi siamo</h1>
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col">
                One of three columns
                </div>
                <div class="col">

                </div>
            </div>
        </div>
    </div>
--}}
    <div id="unisciti" class="home-unisciti">
        <h1 style="color: white; text-align: center; padding-top: 100px; font-size: 42px; font-weight: 700;">Unisciti a noi</h1>
        <p class="subtitle">Compila il modulo e allega il tuo CV</p>
            <div class="form-wrapper">
                <form method="POST" action="{{ route('candidature.send') }}" enctype="multipart/form-data" class="job-form">
                @if(session('ok'))
                    <div class="alert-success">
                        ✔ {{ session('ok') }}
                    </div>
                @endif    
                @csrf

                    <div class="form-group">
                        <label>Nome</label>
                        <input name="nome" required>
                    </div>

                    <div class="form-group">
                        <label>Cognome</label>
                        <input name="cognome" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" required>
                    </div>

                    <div class="form-group">
                        <label>Telefono</label>
                        <input name="telefono" required>
                    </div>

                    <div class="form-group">
                        <label>Carica CV (PDF, DOC, DOCX)</label>
                        <input name="cv" type="file" accept=".pdf,.doc,.docx" required>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" name="privacy" required>
                        <span>Ho letto e accetto l'informativa privacy</span>
                    </div>

                    <button type="submit" class="submit-btn">Invia candidatura</button>
                </form>
            </div>  
    </div>

</div>

@endsection