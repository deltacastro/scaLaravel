<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendario;
use App\Registro;
use App\TipoEvidencia;
use App\Evidencia;
use App\Municipio;
use \Auth;

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
        if (Auth::user()->tipoUsuario > 0) {
            $modelList = $this->registroM->getAll();
            return view('admin.index', compact('modelList'));
        } else {
            return redirect('home');
        }
    }

    public function listImg(Registro $registro, $tipo)
    {
        if (Auth::user()->tipoUsuario > 0) {
            $evidencias = $registro->evidencias->where('tipo_id', $tipo);
            $title = $this->tem->find($tipo)->mostrar;
            return view('admin._listImg', compact('evidencias', 'title'));
        } else {
            return redirect('home');
        }
    }

    public function getCalendarioV ()
    {
        if (Auth::user()->tipoUsuario == 1) {
            $municipios = $this->municipioM->getAll();
            return view('forms._calendarioForm', compact('municipios'));
        } else {
            return redirect('home');
        }
    }

    public function getCalendarioList ()
    {
        if (Auth::user()->tipoUsuario == 1) {
            $calendarioAll = $this->calendarioM->getAll();
            $view = view('lists._calendarioList', compact('calendarioAll')); 
            return response()->json(
                [
                    'type' => 'view',
                    'view' => $view
                ],
                200);
        } else {
            return redirect('home');
        }
    }

    public function postCalendarioV (Request $request)
    {
        if (Auth::user()->tipoUsuario == 1) {
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
        } else {
            return redirect('home');
        }
    }

    public function postCalendarioEliminar (Request $request, Calendario $calendario)
    {
        if (Auth::user()->tipoUsuario == 1) {
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
        } else {
            return redirect('home');
        }
    }

    public function postFolio (Request $request)
    {
        if (Auth::user()->tipoUsuario == 1) {
            $registro = $this->registroM->guardar($request->all());
            return response()->json(
                [
                    'type' => 'fk',
                    'name' => 'registro_id',
                    'value' => $registro->id
                ],
                200);
        } else {
            return redirect('home');
        }
    }

    public function postEvidencia (Request $request)
    {
        if (Auth::user()->tipoUsuario == 1) {
            $fechas = '';
            $listTipoEvi = $this->tem->all()->pluck('id', 'nombre')->toArray();
            $tipo_id = '';
            $files = '';
            $extra = '';
            $evidencia = '';
            $registro_id = $request->get('registro_id');
            $municipio_id = $this->registroM->find($registro_id)->municipio_id;
            $municipioNombre = $this->municipioM->find($municipio_id)->nombre;
            $folio = $this->registroM->find($registro_id)->folio; 
            if ($request->file('entradaSalida') !==null) {
                $tipo_id = $listTipoEvi['entrada y salida'];
                $files = $request->file('entradaSalida');
                $extra = 'entradaSalida';
                $fechas = $request->get('fecha')[$extra];
            } else if ($request->file('gps') !==null) {
                $tipo_id = $listTipoEvi['gps'];
                $files = $request->file('gps');
                $extra = 'gps';
                $fechas = $request->get('fecha')[$extra];
            } else if ($request->file('calendario') !==null) {
                $tipo_id = $listTipoEvi['calendario'];
                $files = $request->file('calendario');
                $extra = 'calendario';
                $fechas = $request->get('fecha')[$extra];
            }

            foreach ($files as $key => $file) {
                $path = $file->store(
                    "evidencias/$municipioNombre/". "$folio/$registro_id/" . $extra .'-'.date('y-m-d:h:m:s'),
                    'public'
                );
                $nombre = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $evidenciaM = new Evidencia;
                $evidenciaM->registro_id = $registro_id;
                $evidenciaM->tipo_id = $tipo_id;
                $evidenciaM->path = $path;
                $evidenciaM->nombre = $nombre;
                $evidenciaM->extension = $extension;
                $evidenciaM->fecha = $fechas[$key];
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
        } else {
            return redirect('home');
        }
    }

}
