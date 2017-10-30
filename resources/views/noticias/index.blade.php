@extends('layouts.app')

@section('content')
    <ul>
        @forelse($noticias as $noticia)
            <li>
                <h1>{{$noticia->titulo}}</h1>
                <p>{{$noticia->subtitulo}}</p>
                <p><a href="{{route('noticias.show', $noticia)}}">Leia mais</a></p>
                <small>Publicado em {{$noticia->published_at->format('d/m/Y H:i')}}, por {{$noticia->autor->name}}</small>
                <hr>
            </li>
        @empty
            Nenhuma notícia encontrada.
        @endforelse
    </ul>
@endsection