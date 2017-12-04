<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $with = ['anexos'];
    protected $dates = ['published_at', 'created_at', 'updated_at'];
    protected $guarded = [];

    public function autor()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function anexos()
    {
        return $this->hasMany('App\Anexo', 'noticia_id', 'id');
    }

    /**
     * @param string $string Recebe a string que será pesquisada no banco
     * @return Model
     */
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', \Carbon\Carbon::now())
            ->where('publicado', '=', true);
    }

    /**
     * @param string $arg Recebe a string que será pesquisada no banco
     * @return Model
     */
    public function scopeSearch($query, $arg = null)
    {
        return $query->where('keywords', 'like', '%' . $arg . '%')
            ->orWhere('titulo', 'like', '%' . $arg . '%')
            ->orWhere('subtitulo', 'like', '%' . $arg . '%')
            ->orWhere('conteudo', 'like', '%' . $arg . '%');
    }

}
