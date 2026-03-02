<h2>Nuova candidatura ricevuta</h2>

<ul>
    <li><strong>Nome:</strong> {{ $data['nome'] }}</li>
    <li><strong>Cognome:</strong> {{ $data['cognome'] }}</li>
    <li><strong>Email:</strong> {{ $data['email'] }}</li>
    <li><strong>Telefono:</strong> {{ $data['telefono'] }}</li>
</ul>

@if(!empty($data['citta']))
    <p><strong>Città/Zona:</strong> {{ $data['citta'] }}</p>
@endif

@if(!empty($data['messaggio']))
    <p><strong>Messaggio:</strong><br>{!! nl2br(e($data['messaggio'])) !!}</p>
@endif

<p>CV allegato in questa email.</p>