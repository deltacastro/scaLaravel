<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    protected $table = 'evidencias';
    protected $fillable = ['registro_id', 'tipo_id', 'path', 'nombre', 'extension', 'fecha'];

    //RELATIONSHIPS

    //ACCESORS

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

    public function getMy($folio_id, $tipo_id) {
        return $this->where('registro_id', $folio_id)->where('tipo_id', $tipo_id)->get();
    }

    public function getAllList() {
        return $this->all()->pluck('correo');
    }
}
