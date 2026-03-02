<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CandidaturaRicevuta;

class CandidaturaController extends Controller
{
    public function create()
    {
        // Blade form: resources/views/candidature/create.blade.php
        return view('candidature.create');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'nome'     => ['required', 'string', 'max:80'],
            'cognome'  => ['required', 'string', 'max:80'],
            'email'    => ['required', 'email', 'max:120'],
            'telefono' => ['required', 'string', 'max:30'],
            'citta'    => ['nullable', 'string', 'max:120'],
            'messaggio'=> ['nullable', 'string', 'max:2000'],
            'cv'       => ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'], // 10MB
            'privacy'  => ['accepted'],
        ]);

        $cv = $request->file('cv');

        // Destinatario: la mail che riceve i CV
        $to = env('CANDIDATURE_TO_EMAIL');

        if (!$to) {
            // Se non hai settato CANDIDATURE_TO_EMAIL in .env/railway variables
            return back()
                ->withInput()
                ->withErrors(['email' => 'Configurazione email non completa (CANDIDATURE_TO_EMAIL mancante).']);
        }

        Mail::to($to)->send(new CandidaturaRicevuta($data, $cv));

        // Se vuoi gestire errori SMTP in modo pulito:
        // if (count(Mail::failures()) > 0) { ... }

        return back()->with('ok', 'Candidatura inviata correttamente. Grazie!');
    }
}