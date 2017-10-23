<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticiasController extends Controller
{
    /**
     * Chama a view de listagem das notícias
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: Do it!
    }

    /**
     * Mostra o formulário de criação da notícia
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO: Do it!
    }

    /**
     * Recebe a requisição de criação da notícia.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO: Do it!
    }

    /**
     * Mostra a notícia
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //TODO: Do it!
    }

    /**
     * Mostra o formulário de edição da notícia.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //TODO: Do it!
    }

    /**
     * Recebe a requisição de edição da notícia
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //TODO: Do it!
    }

    /**
     * Remover a notícia (ou despublicar)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO: Do it!
    }
}
