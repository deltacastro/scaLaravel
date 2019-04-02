<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendario;
use App\Registro;

class GeneralController extends Controller
{
    public function __construct ()
    {
        $this->calendarioM = new Calendario;
        $this->registroM = new Registro;
    }

    public function getCalendarioV ()
    {
        return view('forms._calendarioForm');
    }

    public function getCalendarioList ()
    {
        $calendarioAll = $this->calendarioM->getAll();
        $view = view('lists._calendarioList', compact('calendarioAll')); 
        return response()->json(
            [
                'type' => 'view',
                'view' => $view
            ],
            200);
    }

    public function postCalendarioV (Request $request)
    {
        $this->calendarioM->guardar($request->all());
        $calendarioAll = $this->calendarioM->getAll();
        $view = view('lists._calendarioList', compact('calendarioAll'))->render(); 
        return response()->json(
            [
                'type' => 'view',
                'view' => $view
            ],
            200
        );
    }

    public function postCalendarioEliminar (Request $request, Calendario $calendario)
    {
        $result = $calendario->eliminar();
        $calendarioAll = $this->calendarioM->getAll();
        $view = view('lists._calendarioList', compact('calendarioAll'))->render(); 
        return response()->json(
            [
                'type' => 'view',
                'view' => $view
            ],
            200
        );
    }

    public function postFolio (Request $request)
    {
        $registro = $this->registroM->guardar($request->all());
        return response()->json(
            [
                'type' => 'fk',
                'name' => 'registro_id',
                'value' => $registro->id
            ],
            200);
    }

}
