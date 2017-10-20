<?php

namespace App\Http\Controllers;

use App\Categoria;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Categoria::with('filhas')->find(5);
        return $cat;
    }
}
