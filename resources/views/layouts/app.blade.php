<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="{{asset('css/estilo.css')}}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
            integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
            crossorigin="anonymous"></script>
            <script src="{{asset('/js/app.js')}}"></script>

    <title>@yield('title')</title>
</head>
<body>
<div class="wrapper">
    <div class="header container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{asset('imagens/googleCloudPlataform.png')}}"/>
            </div>
            <div class="col-md-2">
                <div class="pesquisa">
                    <form action="{{route('noticias.search')}}" method="get">
                        <input type="text" name="q" class="pesquisaInput" size="23" height="50px"
                               placeholder="Pesquisar" value="{{isset($_GET['q']) ? $_GET['q'] : ''}}">
                    </form>
                </div>
            </div>
            <div class="col-md-2">
                @if(Auth::check())
                    {{Auth::user()->name}}
                    <form id="logout" action="{{route('logout')}}" method="post">
                        {{csrf_field()}}
                        <a href="#logout" onclick="document.getElementById('logout').submit();">Sair</a>
                    </form>
                @else
                    <a href="{{route('login')}}">Login</a>
                    <a href="{{route('registrar')}}">Registrar-se</a>
                @endif
            </div>
            <div class="col-md-2">
                <img src="{{asset('imagens/tresPontos.png')}}">
                @if(Auth::check())
                    <img height="40px" src="{{Auth::user()->image()}}"/>
                @endif
            </div>
        </div>
    </div>
    <div class="ads">
        <div class="container">
            <div class="esquerda">
                <div class="porQueOGoogle"><a href="{{url('/')}}">Home</a></div>
                <div class="porQueOGoogle"><a href="{{route('noticias.index')}}">Noticias</a></div>
                <div class="porQueOGoogle"><a href="{{route('noticias.create')}}">Adicionar Noticia</a></div>
            </div>
            <div class="direita">
                <div class="entreEmContato">
                    <a Title="entreEmContato">ENTRE EM CONTATO</a>
                </div>
                <div class="testeGratis">
                    <a Title="TesteGratis">TESTAR GRATUITAMENTE</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @yield('content')
    </div>
</div>
<div id="loading" style="display: none"><div>    


</body>
</html>