@extends('layouts.app')

@section('content')
    <ul>
        @forelse($noticias as $noticia)
            <li>
                <h1>{{$noticia->titulo}}</h1>
                <p>{{$noticia->subtitulo}}</p>
                <p><a href="{{route('noticias.show', $noticia)}}">Leia mais</a></p>
                <hr>
            </li>
        @empty
            Nenhuma notícia cadastrada.
        @endforelse
    </ul>
@endsection