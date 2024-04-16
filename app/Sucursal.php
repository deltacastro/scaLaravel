<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    protected $fillable = ['municipio_id', 'nombre'];
    protected $dates = ['created_at', 'updated_at'];
}
