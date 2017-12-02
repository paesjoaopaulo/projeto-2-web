<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link href="{{asset('css/estilo.css')}}" rel="stylesheet">

    <script src="/js/jquery-2.2.4.js"></script>

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

<div id="loading" style="display: none"></div>

<script src="{{asset('/js/app.js')}}"></script>
</body>
</html>