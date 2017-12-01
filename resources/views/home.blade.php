@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <h2>Noticias</h2>
    <ul>
        @forelse($noticias as $noticia)
            <li><a href="{{route('noticias.show', $noticia)}}">{{$noticia->titulo}}</a></li>
        @empty
            Nenhuma notícia encontrada
        @endforelse
    </ul>

    <h2>Autores</h2>
    <ul>
        @forelse($autores as $autor)
            <li><img height="40px" width="40px" src="{{$autor->image()}}">{{$autor->name}}</li>
        @empty
            Nenhuma notícia encontrada
        @endforelse
    </ul>
@endsection
