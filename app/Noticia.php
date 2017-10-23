<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $with = ['anexos'];
    public function autor()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function anexos(){
        return $this->hasMany('App\Anexo', 'noticia_id', 'id');
    }

    /**
     * @param string $string Recebe a string que será pesquisada no banco
     * @return Noticia|Collection
     */
    public static function search($string = "")
    {
        return
            self::where('keywords', 'like', '%'.$string.'%')
            ->orWhere('titulo', 'like', '%'.$string.'%')
            ->orWhere('subtitulo', 'like', '%'.$string.'%')
            ->orWhere('conteudo', 'like', '%'.$string.'%');
    }
}
