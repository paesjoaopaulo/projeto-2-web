<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function filhas(){
        return $this->hasMany('App\Categoria', 'categoria_id', 'id');
    }
    
    public function mae(){
        return $this->belongsTo('App\Categoria', 'categoria_id', 'id');
    }
}
