<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticia;

class HomeController extends Controller
{
    /**
     * Exibe a view home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::orderBy('published_at', 'DESC')->get();
        return view('home', compact('noticias'));
    }
}
