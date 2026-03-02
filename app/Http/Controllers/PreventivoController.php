<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RichiestaPreventivo;

class PreventivoController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'nome' => ['required','string','max:80'],
            'cognome' => ['required','string','max:80'],
            'email' => ['required','email','max:120'],
            'telefono' => ['required','string','max:30'],
            'servizio' => ['required','string','max:50'],
            'zona' => ['required','string','max:120'],
            'messaggio' => ['required','string','max:2000'],
        ]);

        $to = env('CANDIDATURE_TO_EMAIL'); // puoi rinominarla in PREVENTIVI_TO_EMAIL se vuoi

        Mail::to($to)->send(new RichiestaPreventivo($data));

        return back()->with('ok_preventivo', 'Richiesta inviata! Ti contatteremo al più presto.');
    }
}