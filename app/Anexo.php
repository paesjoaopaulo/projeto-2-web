<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    public function noticia()
    {
        return $this->belongsTo('App\Noticia', 'noticia_id', 'id');
    }

    public function isVideo()
    {
        $matches = preg_split('/\//', $this->type);
        if (in_array('video', $matches)) {
            return true;
        }
        return false;
    }

    public function isImage()
    {
        $matches = preg_split('/\//', $this->type);
        if (in_array('image', $matches)) {
            return true;
        }
        return false;
    }
}
