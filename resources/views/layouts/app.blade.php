<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link href="{{asset('css/estilo.css')}}" rel="stylesheet">
	<title> TITULO</title>
</head>
<body>
	<div class="wrapper"> 
		<div class="header">
			<div class="googleCloudPlataform">
				<img src="{{asset('imagens/googleCloudPlataform.png')}}"/>
			</div>
			<div class="minhaConta">
				<img src="{{asset('imagens/minhaImagem.png')}}" />
			</div>			
			<div class="configuracoesUsuario">
				<img src="{{asset('imagens/tresPontos.png')}}">
			</div>
			<div class="console">			
			@if(Auth::check())
				{{Auth::user()->name}}
				<form id="logout" action="{{route('logout')}}" method="post">
					{{csrf_field()}}
					<a href="#logout" onclick="document.getElementById('logout').submit();">Sair</a>
				</form>
			@else
				<a href="{{route('login')}}">Login</a>
			@endif
			</div>
			<div class="pesquisa">
                <form action="{{route('noticias.search')}}" method="get">
				    <input type="text" name="q" class="pesquisaInput" size="23" height="50px" placeholder="Pesquisar" value="{{isset($_GET['q']) ? $_GET['q'] : ''}}">
                </form>
			</div>	
		</div>
		<div class="ads">
			<div class="esquerda"> st
				<div class="porQueOGoogle">Por que o Google</div>
				<div class="produtos">Produtos</div>
				<div class="solucoes">Soluções</div>
				<div class="launcher">Launcher</div>
				<div class="precos">Preços</div>
				<div class="clientes">Clientes</div>
				<div class="documentacao">Documentação</div>
			</div>
			<div class="direita">
				<div class="botaoRolagem">
					<a href="#" Title="botaoRolagem"><img src="{{asset('imagens/mais.png')}}"/></a>
				</div>
				<div class="entreEmContato">
					<a Title="entreEmContato">ENTRE EM CONTATO</a>
				</div>
				<div class="testeGratis">
					<a Title="TesteGratis">TESTAR GRATUITAMENTE</a>
				</div>
			</div>
		</div>
		<div class="corpo">
            @yield('content')
        </div>
	</div>
</body>
</html>