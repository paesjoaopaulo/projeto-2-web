@extends('layouts.app')

@section('content')
<h2>Noticias</h2>
<ul>
    @foreach($noticias as $noticia)
        <li>{{$noticia->titulo}}</li>
    @endforeach
</ul>
@endsection
