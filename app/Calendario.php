<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'calendarios';
    protected $fillable = ['folio_id, fecha, hora'];
}
