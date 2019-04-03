<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';
    
    protected $fillable = ['nombre'];

    public function getAll() {
        return $this->all();
    }


}
