<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{asset('/libs/materialize/css/materialize.css')}}" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{asset('/css/style.css')}}" media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    <div class="row topo">
        <div class="col s8">
            <img src="{{asset('/imagens/gcp-logo.svg')}}" width="254px" />
        </div>
        <div class="col s2">Search</div>
        <div class="col s2">Login</div>
    </div>
    <div class="row menu">
        <div class="col s9">Menu</div>
        <div class="col s3">
            <a class="btn btn-primary btn-small">TESTE GRÁTIS</a>
            <a class="btn btn-default btn-small">ENTRE EM CONTATO</a>
        </div>
    </div>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/libs/materialize/js/materialize.js"></script>
</body>

</html>