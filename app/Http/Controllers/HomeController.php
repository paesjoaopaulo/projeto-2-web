<?php

namespace App\Http\Controllers;

use App\Noticia;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Exibe a view home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::published()->orderBy('published_at', 'DESC')->get();
        $autores = User::orderBy('name', 'ASC')->get();
        return view('home', compact('noticias', 'autores'));
    }
}
