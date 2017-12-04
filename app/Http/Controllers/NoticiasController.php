<?php

namespace App\Http\Controllers;

use App\Noticia;
use App\Anexo;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Mockery\Exception;
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
        $this->middleware('redirectIfGuest', ['only' => ['create', 'store']]);
    }

    /**
     * Chama a view de listagem das notícias
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $noticias = Noticia::published()->get();
        if ($request->ajax()) {
            return $noticias;
        }
        return view('noticias.index', compact('noticias'));
    }

    /**
     * Mostra o formulário de criação da notícia
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $noticias = Noticia::orderBy('id', 'DESC')->limit(5)->get();
        return view('noticias.create', compact('noticias'));
    }

    /**
     * Recebe a requisição de criação da notícia.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        sleep(1);
        try {
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return response([
                    "error" => true,
                    "errorMessage" => $validator->getMessageBag()
                ], Response::HTTP_BAD_REQUEST);
            }

            $noticia = new Noticia();
            $noticia->titulo = $request->get('titulo');
            $noticia->subtitulo = $request->get('subtitulo');
            $noticia->conteudo = $request->get('conteudo');
            $noticia->keywords = $request->get('keywords');
            $noticia->categoria_id = 1;
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
            return response([
                "error" => false,
                "resource" => $noticia
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response([
                "erro" => true,
                "message" => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
    public function search(Request $request)
    {
        $noticias = Noticia::published()->search($request->get('q'))->get();
        return view('noticias.index', compact('noticias'))->withInput(['pesquisa', $request->get('q')]);
    }

    public function searchTitulo(Request $request)
    {
        sleep(1);
        return Noticia::where('titulo', 'like', '%' . $request->get('q') . '%')->orderBy('titulo')->limit(5)->get();
    }
}
