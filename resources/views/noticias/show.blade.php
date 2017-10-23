@extends('layouts.app')

@section('content')
    <h1>{{$noticia->titulo}}</h1>
    <h2>{{$noticia->subtitulo}}</h2>
    <p>{{$noticia->conteudo}}</p>
    @if($anexo)
        <?php preg_match('/(video)/', $anexo->type, $matches) ?>

        @if( $anexo->isVideo() )
            <video src="{{asset('storage/uploads/'.$anexo->path)}}" width="640" height="480" controls="true"></video>
        @elseif( $anexo->isImage() )
            <img src="{{asset('storage/uploads/'.$anexo->path)}}" width="640" height="480"/>
        @endif
    @endif

@endsection