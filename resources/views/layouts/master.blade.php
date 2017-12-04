<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Google Cloud Platform - @yield('title')</title>

    <!-- Libs -->
    <script src="{{asset('/js/jquery-2.2.4.js')}}" type="text/javascript"></script>
    <script src="{{asset('/libs/bootstrap/js/bootstrap.js')}}" type="text/javascript"></script>

    <!-- Estilo -->
    <link rel="stylesheet" href="{{asset('/libs/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>

<body>
<div id="loader"></div>
<div class="container">
    <div id="topo">
        <div class="row">
            <div class="col-md-7">
                <div id="logo">
                    <img src="{{asset('/imagens/gcp-logo.svg')}}" width="250px"/>
                </div>
            </div>
            <div class="col-md-3">
                <div id="busca">
                    <div class="input-group">
                            <span class="input-group-addon loading">
                                <i class="glyphicon glyphicon-search"></i>
                            </span>
                        <input name="q" id="q" class="form-control" placeholder="Pesquisar" autocomplete="off">
                    </div>
                    <div id="search-loader"></div>
                    <div id="searchResults" style="display: none">
                        <ul class="list-unstyled"></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="dropdown">
                    <img id="user-photo" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                         aria-expanded="true"
                         src="https://lh5.googleusercontent.com/-7ZJPKRN9rKc/AAAAAAAAAAI/AAAAAAAAAL8/V3irR3cbTUU/photo.jpg?sz=64"
                         width="32px"/>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li>
                            <a href="#" onclick="$('#formLogout').submit()">Sair</a>
                        </li>
                        <form id="formLogout" action="{{route('logout')}}" method="post"></form>
                    </ul>
                </div>
            </div>
        </div>
        <div id="menu">
            <ul class="nav nav-pills">
                <li>
                    <a href="{{route('home')}}">Home</a>
                </li>
                <li>
                    <a href="{{route('noticias.index')}}">Notícias</a>
                </li>
                <li>
                    <a href="{{route('noticias.create')}}">Adicionar Notícias</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>
</div>
<!-- Scripts -->
<script src="{{asset('/js/AjaxRequest.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/master.js')}}" type="text/javascript"></script>

</body>

</html>