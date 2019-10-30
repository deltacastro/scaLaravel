<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';
    
    protected $fillable = ['nombre', 'estado_id'];

    public function getAll() {
        return $this->all();
    }

    public function getAllList()
    {
        return $this->all()->pluck('nombre', 'id');
    }
}
