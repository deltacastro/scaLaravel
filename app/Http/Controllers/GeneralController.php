<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendario;

class GeneralController extends Controller
{
    public function __construct ()
    {
        $this->calendarioM = new Calendario;
    }

    public function getCalendarioV ()
    {
        return view('forms._calendarioForm');
    }

    public function postCalendarioV (Request $request)
    {
        dd($request->all());
        return view('forms._calendarioForm');
    }

}
