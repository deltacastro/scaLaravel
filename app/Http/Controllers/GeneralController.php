<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendario;
use App\Registro;
use App\TipoEvidencia;
use App\Evidencia;
use App\Municipio;


class GeneralController extends Controller
{
    public function __construct ()
    {
        $this->calendarioM = new Calendario;
        $this->registroM = new Registro;
        $this->tem = new TipoEvidencia;
        $this->evidenciaM = new Evidencia;
        $this->municipioM = new Municipio;
    }

    public function index()
    {
        $modelList = $this->registroM->getAll();
        return view('admin.index', compact('modelList'));
    }

    public function listImg(Registro $registro, $tipo)
    {
        $evidencias = $registro->evidencias->where('tipo_id', $tipo);
        $title = $this->tem->find($tipo)->nombre;
        return view('admin._listImg', compact('evidencias', 'title'));
    }

    public function getCalendarioV ()
    {
        $municipios = $this->municipioM->getAll();
        return view('forms._calendarioForm', compact('municipios'));
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

    public function postEvidencia (Request $request)
    {
        $listTipoEvi = $this->tem->all()->pluck('id', 'nombre')->toArray();
        $tipo_id = '';
        $files = '';
        $extra = '';
        $evidencia = '';
        $registro_id = $request->get('registro_id');
        $folio = $this->registroM->find($registro_id)->folio; 
        if ($request->file('entradaSalida') !==null) {
            $tipo_id = $listTipoEvi['entrada y salida'];
            $files = $request->file('entradaSalida');
            $extra = 'entradaSalida';
        } else if ($request->file('gps') !==null) {
            $tipo_id = $listTipoEvi['gps'];
            $files = $request->file('gps');
            $extra = 'gps';
        } else if ($request->file('calendario') !==null) {
            $tipo_id = $listTipoEvi['calendario'];
            $files = $request->file('calendario');
            $extra = 'calendario';
        }

        foreach ($files as $key => $file) {
            $path = $file->store(
                'evidencias/'. "$folio/" . $extra .'-'.date('y-m-d:h:m:s'),
                'public'
            );
            $nombre = $file->getClientOriginalName();
            $extension = $file->->getClientOriginalExtension();
            $evidenciaM = new Evidencia;
            $evidenciaM->registro_id = $registro_id;
            $evidenciaM->tipo_id = $tipo_id;
            $evidenciaM->path = $path;
            $evidenciaM->nombre = $nombre;
            $evidenciaM->extension = $extension;
            $evidencia = $evidenciaM->save();
        }

        $evidenciasAll = $this->evidenciaM->getMy($registro_id, $tipo_id);

        $view = view('lists._fileList', compact('evidenciasAll'))->render(); 
        return response()->json(
            [
                'type' => 'view',
                'view' => $view,
                'class' => $extra
            ],
            200
        );
    }

}
