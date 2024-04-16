<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Calendario;
use App\Registro;
use App\TipoEvidencia;
use App\Evidencia;
use App\Municipio;
use \Auth;
use \ZipArchive;

class GeneralController2 extends Controller
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
            $evidencias = $registro->evidencias()->where('tipo_id', $tipo)->orderBy('fecha', 'ASC')->get();
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

    public function editRegistro (Registro $registro)
    {
        if (Auth::user()->tipoUsuario == 1) {
            $municipios = $this->municipioM->getAll();
            $evidenciasCal = $registro->evidencias->where('tipo_id', 1);
            $entradasSalidas = $registro->evidencias->where('tipo_id', 2);
            $gpss = $registro->evidencias->where('tipo_id', 3);
            return view('forms._editForm', compact('municipios', 'registro', 'evidenciasCal', 'entradasSalidas', 'gpss'));
        } else {
            return redirect('home');
        }
    }

    public function updateRegistro (Request $request, Registro $registro)
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

            $municipios = $this->municipioM->getAll();
            $evidencias = $registro->evidencias->where('tipo_id', $tipo_id);
            $view = view('lists._fileList', compact('evidencias'))->render();
            return response()->json(
                [
                    'type' => 'view',
                    'view' => $view,
                    'class' => "loadList$extra"
                ],
                200
            );
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

    public function postEvidenciaEliminar (Request $request, Evidencia $evidencia)
    {
        if (Auth::user()->tipoUsuario == 1) {
            // dd($evidencia);
            $registro_id = $evidencia->registro_id;
            $tipo_id = $evidencia->tipo_id;
            $extra = '';
            if ($evidencia->tipo_id == 1) {
                $extra = 'calendario';
            } else if ($evidencia->tipo_id == 2) {
                $extra = 'entradaSalida';
            } else if ($evidencia->tipo_id == 3) {
                $extra = 'gps';
            }
            $result = $evidencia->eliminar();
            $evidencias = $this->evidenciaM->where('registro_id', $registro_id)->where('tipo_id', $tipo_id)->get();

            $view = view('lists._fileList', compact('evidencias'))->render();
            return response()->json(
                [
                    'type' => 'view',
                    'view' => $view,
                    'class' => "loadList$extra"
                ],
                200
            );
        } else {
            return redirect('home');
        }
    }

    public function postRegistroEliminar (Request $request, Registro $registro)
    {
        if (Auth::user()->tipoUsuario == 1) {
            $result = $registro->eliminar();
            $modelList = $this->registroM->getAll();
            $view = view('admin._loadTable', compact('modelList'))->render();
            return response()->json(
                [
                    'type' => 'view',
                    'view' => $view,
                    'class' => "loadTable"
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

            // $evidencias = $this->evidenciaM->getMy($registro_id, $tipo_id);

            // $view = view('lists._fileList', compact('evidencias'))->render();
            return response()->json(
                [
                    // 'type' => 'view',
                    // 'view' => $view,
                    // 'class' => $extra
                ],
                200
            );
        } else {
            return redirect('home');
        }
    }

    public function downloadZip(Registro $registro)
    {
        $responseDownload = null;

        $registroFolio = $registro->folio;

        $evidencias = $registro->evidencias;

        //Nombre aleatorio de la carpeta
        $randomString = str_random(40);

        // Carpeta raiz donde se copiaran los archivos
        $toFolder = "temp/$randomString";

        // Carpeta raiz donde se generaran nuestros zips
        $rootFolderZip = 'temp/zips/';

        // Creamos la carpeta root del zip en caso de que no exista
        Storage::disk('local')->makeDirectory($rootFolderZip);

        // Carpeta y nombre del zip donde se va a crear
        $folderZip = Storage::disk('local')->path("$rootFolderZip/$registroFolio.zip");

        foreach ($evidencias as $evidencia) {

            $evidenciaNombre = $evidencia->nombre;

            $evidenciaPath = $evidencia->path;

            $evidenciaTipo = $evidencia->tipoEvidencia->nombre;

            // Carpeta raiz de los archivos que se vana copiar
            $fileCopy = "public/$evidenciaPath";

            // Nombre del archivo zip
            $zipFileName = "$registroFolio.zip";

            // Se copio el archivo?
            $statusFileCp = Storage::disk('local')->copy($fileCopy, "$toFolder/$evidenciaNombre");

            // full path del archivo copiado
            $fullPathCopyFile = Storage::disk('local')->path("$toFolder/$evidenciaNombre");

            //instancia
            $zip = new ZipArchive;

            if ($zip->open($folderZip, ZipArchive::CREATE) === TRUE) {

                $zip->addFile($fullPathCopyFile, "$evidenciaTipo/$evidenciaNombre");

                $zip->close();
            }

        }

        // Eliminamos la carpeta que se copio
        $statusFileDl = Storage::disk('local')->deleteDirectory($toFolder);

        // Set Header
        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );

        // Creamos el response de descarga
        if(file_exists($folderZip)){
            $responseDownload = response()->download($folderZip,$zipFileName,$headers)->deleteFileAfterSend(true);
        }

        return $responseDownload;
    }

}