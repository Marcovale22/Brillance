<h2>Nuova richiesta preventivo</h2>

<ul>
    <li><strong>Nome:</strong> {{ $data['nome'] }} {{ $data['cognome'] }}</li>
    <li><strong>Email:</strong> {{ $data['email'] }}</li>
    <li><strong>Telefono:</strong> {{ $data['telefono'] }}</li>
    <li><strong>Servizio:</strong> {{ $data['servizio'] }}</li>
    <li><strong>Zona:</strong> {{ $data['zona'] }}</li>
</ul>

<p><strong>Messaggio:</strong><br>{!! nl2br(e($data['messaggio'])) !!}</p>