<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CandidaturaRicevuta;
use App\Jobs\InviaCandidaturaJob;

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
            'nome'     => ['required','string','max:80'],
            'cognome'  => ['required','string','max:80'],
            'email'    => ['required','email','max:120'],
            'telefono' => ['required','string','max:30'],
            'cv'       => ['required','file','mimes:pdf,doc,docx','max:10240'],
            'privacy'  => ['accepted'],
        ]);

        $to = env('CANDIDATURE_TO_EMAIL');

        // ⚠️ togli l'UploadedFile dall'array data
        unset($data['cv']);

        $cv = $request->file('cv');
        $data['cv_original'] = $cv->getClientOriginalName();

        // salva file e passa SOLO il path
        $tmpPath = $cv->store('tmp/cv'); // es: tmp/cv/abc123.pdf

        InviaCandidaturaJob::dispatch($data, $tmpPath, $to);

        return back()->with('ok', 'Candidatura inviata! Grazie.');
    }
}