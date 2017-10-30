@extends('layouts.app')

@section('content')
    <h2>Noticias</h2>
    <ul>
        @foreach($noticias as $noticia)
            <li>{{$noticia->titulo}}</li>
        @endforeach
    </ul>

    <h2>Autores</h2>
    <ul>
        @foreach($autores as $autor)
            <li><img height="40px" width="40px" src="{{$autor->image()}}">{{$autor->name}}</li>
        @endforeach
    </ul>
@endsection
