<?php

namespace App\Http\Controllers;

use App\Noticia;
use App\Anexo;
use Illuminate\View\View;
use Ramsey\Uuid\Uuid;

use Illuminate\Http\Request;

use Validator;
use Auth;

class NoticiasController extends Controller
{
    public function __construct()
    {
        /**
         * O validação de usuário autenticado só será aplicado para as rotas create e store.
         */
        //$this->middleware('redirectIfGuest', ['only' => ['create', 'store']]);
    }

    /**
     * Chama a view de listagem das notícias
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::published()->get();
        return view('noticias.index', compact('noticias'));
    }

    /**
     * Mostra o formulário de criação da notícia
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noticias.create');
    }

    /**
     * Recebe a requisição de criação da notícia.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        var_dump($request->all());
        die;
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->getMessageBag());
        }
        $noticia = new Noticia();
        $noticia->titulo = $request->get('titulo');
        $noticia->subtitulo = $request->get('subtitulo');
        $noticia->conteudo = $request->get('conteudo');
        $noticia->keywords = $request->get('keywords');
        $noticia->published_at = $request->get('published_at');
        $noticia->publicado = ($request->get('publicado') == 'on') ? true : false;
        $noticia->user_id = Auth::id();
        $noticia->save();

        if ($request->hasFile('anexo')) {
            $nomeArquivo = Uuid::uuid4();
            $anexoFile = $request->file('anexo');
            $anexoFile->storeAs('uploads', $nomeArquivo . '-' . $anexoFile->getClientOriginalName(), 'public');
            $anexo = new Anexo();
            $anexo->path = $nomeArquivo . '-' . $anexoFile->getClientOriginalName();
            $anexo->type = $anexoFile->getClientMimeType();
            $anexo->noticia_id = $noticia->id;
            $anexo->save();
        }

        return redirect()->route('noticias.show', $noticia);
    }

    /**
     * Mostra a notícia
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noticia = Noticia::find($id);
        if ($noticia->anexos()->count()) {
            $anexo = $noticia->anexos[0];
        } else {
            $anexo = null;
        }
        return view('noticias.show', compact('noticia', 'anexo'));
    }

    /**
     * Validação para os dados de entrada.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'titulo' => 'required|string|max:255',
            'subtitulo' => 'required|string|max:255',
            'conteudo' => 'required|string|min:10',
            'keywords' => 'string|min:3|max:255',
            'published_at' => 'required|date',
            'anexo' => 'file|mimes:jpeg,jpg,png,mp4,video/mp4',
        ]);
    }

    /**
     * Processa a palavra pesquisada.
     *
     * @param $search string
     * @return View
     */
    protected function search(Request $request)
    {
        $noticias = Noticia::published()->search($request->get('q'))->get();
        return view('noticias.index', compact('noticias'))->withInput(['pesquisa', $request->get('q')]);
    }
}
