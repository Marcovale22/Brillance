<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\InviaCandidaturaJob;

class CandidaturaController extends Controller
{
    public function create()
    {
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

        $cv = $request->file('cv');

        unset($data['cv']);

        $cvContent = base64_encode(file_get_contents($cv->getRealPath()));
        $cvOriginalName = $cv->getClientOriginalName();
        $cvMimeType = $cv->getMimeType();

        InviaCandidaturaJob::dispatch(
            $data,
            $cvContent,
            $cvOriginalName,
            $cvMimeType,
            $to
        );

        return back()->with('ok', 'Candidatura inviata! Grazie.');
    }
}