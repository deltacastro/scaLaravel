<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTime;

class Registro extends Model
{
    protected $table = 'registros';
    protected $fillable = ['folio', 'totalHoras', 'fechaInicio', 'fechaFin', 'municipio_id'];

    //RELATIONSHIPS

    public function evidencias()
    {
        return $this->hasMany('App\Evidencia', 'registro_id', 'id');
    }

    public function municipio()
    {
        return $this->belongsTo('App\Municipio', 'municipio_id');
    }

    //ACCESORS
    //MUTATORS

    public function getFechaInicioMesAttribute($value)
    {
        $value = $this->fechaInicio;
        $mes = [
            'no',
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre'
        ];
        $fecha = strtotime($value);
        // or if you want to output a date in year/month/day format:
        $date = date("n", $fecha);
        return $mes[$date];
    }
    //INTERNAL FUNCTIONS

    private function buildDataFillable ($data) {
        $dataFillable = array();
        foreach ($this->fillable as $value) {
            $dataFillable[$value] = isset($data[$value]) ? $data[$value] : null;
        }
        return $dataFillable;
    }

    //CRUD FUNCTIONS

    public function guardar($data) {
        $data = $this->buildDataFillable($data);
        $data['created_by'] = \Auth::user()->id;
        $data['updated_by'] = \Auth::user()->id;
        $data = $this->create($data);
        return $data;
    }

    public function actualizar($data, $model) {
        $data = $this->buildDataFillable($data);
        unset($data['created_by']);
        $data['updated_by'] = \Auth::user()->id;
        $data = $model->fill($data)->save();
        return $data ? $this->find($model->id) : false;
    }

    public function eliminar() {
        return $this->delete();
    }

    public function getAll() {
        return $this->all();
    }

    public function getAllList() {
        return $this->all()->pluck('correo');
    }

    public function checkCalendario()
    {
        return $this->evidencias->where('tipo_id', 1)->count();
    }
    
    public function checkReporte()
    {
        return $this->evidencias->where('tipo_id', 2)->count();
    }
    
    public function checkGps()
    {
        return $this->evidencias->where('tipo_id', 3)->count();
    }

}
