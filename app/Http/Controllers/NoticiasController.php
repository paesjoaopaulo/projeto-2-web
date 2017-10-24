<?php

namespace App\Http\Controllers;

use App\Noticia;
use App\Anexo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Ramsey\Uuid\Uuid;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Validator;
use Auth;

class NoticiasController extends Controller
{
    public function __construct(){
        $this->middleware('redirectIfGuest', ['only' => ['create','store']]);
    }

    /**
     * Chama a view de listagem das notícias
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::all();
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

        return $noticia->with('anexos')->get();
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
     * Mostra o formulário de edição da notícia.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //TODO: Do it!
    }

    /**
     * Recebe a requisição de edição da notícia
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //TODO: Do it!
    }

    /**
     * Remover a notícia (ou despublicar)
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO: Do it!
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
        $noticias = Noticia::search($request->get('q'))->get();
        return view('noticias.index', compact('noticias'))->withInput(['pesquisa', $request->get('q')]);
    }
}
