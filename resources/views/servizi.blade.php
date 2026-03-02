@extends('base')

@section('title', config('app.name') . ' - servizi')

@section('content')
<div class="home-preventivi">
    <section class="preventivo-section" id="preventivo">
        <div class="preventivo-container">

            <div class="preventivo-left">
                <h2>Richiedi un Preventivo</h2>
                <p>
                    Compila il modulo: ti risponderemo il prima possibile con una proposta su misura
                    per condomini, uffici e negozi.
                </p>

                <ul class="preventivo-points">
                    <li>✓ Risposta rapida</li>
                    <li>✓ Sopralluogo su richiesta</li>
                    <li>✓ Preventivo gratuito</li>
                </ul>
            </div>

            <div class="preventivo-right">
                @if(session('ok_preventivo'))
                    <div class="alert-success">{{ session('ok_preventivo') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert-error">
                        <strong>Controlla i campi:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="preventivo-form" method="POST" action="{{ route('preventivo.send') }}">
                    @csrf

                    <div class="row-2">
                        <div class="form-group">
                            <label>Nome</label>
                            <input name="nome" value="{{ old('nome') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Cognome</label>
                            <input name="cognome" value="{{ old('cognome') }}" required>
                        </div>
                    </div>

                    <div class="row-2">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Telefono</label>
                            <input name="telefono" value="{{ old('telefono') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tipo servizio</label>
                        <select name="servizio" required>
                            <option value="" disabled {{ old('servizio') ? '' : 'selected' }}>Seleziona...</option>
                            <option value="Condomini" {{ old('servizio') === 'Condomini' ? 'selected' : '' }}>Condomini</option>
                            <option value="Aziende e Uffici" {{ old('servizio') === 'Aziende e Uffici' ? 'selected' : '' }}>Aziende e Uffici</option>
                            <option value="Negozi" {{ old('servizio') === 'Negozi' ? 'selected' : '' }}>Negozi</option>
                            <option value="Altro" {{ old('servizio') === 'Altro' ? 'selected' : '' }}>Altro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Città / Zona</label>
                        <input name="zona" value="{{ old('zona') }}" placeholder="Es. Roma - Nomentano" required>
                    </div>

                    <div class="form-group">
                        <label>Messaggio</label>
                        <textarea name="messaggio" rows="4" placeholder="Descrivi cosa ti serve (metri quadri, frequenza, ecc.)" required>{{ old('messaggio') }}</textarea>
                    </div>

                    <button class="submit-btn" type="submit">Invia richiesta</button>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection