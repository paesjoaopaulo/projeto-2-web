<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'logradouro', 'cidade', 'estado', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function noticias()
    {
        return $this->hasMany('App\Noticia', 'user_id');
    }

    public function image()
    {
        if (empty($this->photo) || is_null($this->photo)) {
            return asset("imagens/user_default.png");
        } else {
            return asset("storage/uploads/" . $this->photo);
        }
    }
}
