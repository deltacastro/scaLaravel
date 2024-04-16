<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    
    protected $fillable = ['nombre'];

    public function getAll() {
        return $this->all();
    }

    public function getAllList()
    {
        return $this->all()->pluck('nombre', 'id');
    }
}
