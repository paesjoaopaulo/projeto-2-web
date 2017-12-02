@extends('layouts.app')

@section('title')
    Nova Notícia
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
    <form id="frm_cadastrarNoticia" enctype="multipart/form-data">
        <fieldset>
        <h2>Nova Notícia</h2>

            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                <label for="titulo" class="col-md-4 control-label">Título</label>
                <div class="col-md-6">
                    <input id="titulo" type="text" class="form-control" name="titulo" value="{{ old('titulo') }}"
                            autofocus>
                    @if ($errors->has('titulo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('titulo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('subtitulo') ? ' has-error' : '' }}">
                <label for="subtitulo" class="col-md-4 control-label">Subtítulo</label>
                <div class="col-md-6">
                    <input id="subtitulo" type="text" class="form-control" name="subtitulo"
                           value="{{ old('subtitulo') }}"  autofocus>
                    @if ($errors->has('subtitulo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('subtitulo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('conteudo') ? ' has-error' : '' }}">
                <label for="conteudo" class="col-md-4 control-label">Conteúdo</label>
                <div class="col-md-6">
                    <textarea id="conteudo" class="form-control" name="conteudo" 
                              autofocus>{{ old('conteudo') }}</textarea>
                    @if ($errors->has('conteudo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('conteudo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('keywords') ? ' has-error' : '' }}">
                <label for="keywords" class="col-md-4 control-label">Keywords</label>
                <div class="col-md-6">
                    <input id="keywords" type="text" class="form-control" name="keywords" value="{{ old('keywords') }}"
                           autofocus>
                    @if ($errors->has('keywords'))
                        <span class="help-block">
                            <strong>{{ $errors->first('keywords') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('publicado') ? ' has-error' : '' }}">
                <label for="publicado" class="col-md-4 control-label">Publicar</label>
                <div class="col-md-6">

                    <div class="form-check">
                        <label class="form-check-label">
                            <input id="publicado" class="form-check-input" type="checkbox" name="publicado"
                                   value="on" checked autofocus>
                        </label>
                    </div>
                    @if ($errors->has('publicado'))
                        <span class="help-block">
                            <strong>{{ $errors->first('publicado') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('published_at') ? ' has-error' : '' }}">
                <label for="published_at" class="col-md-4 control-label">Data de publicação</label>
                <div class="col-md-6">
                    <input id="published_at" type="date" name="published_at" class="form-control"
                           value="{{ old('published_at') }}"  autofocus>
                    @if ($errors->has('published_at'))
                        <span class="help-block">
                            <strong>{{ $errors->first('published_at') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('anexo') ? ' has-error' : '' }}">
                <label for="anexo" class="col-md-4 control-label">Anexo</label>
                <div class="col-md-6">
                    <input id="anexo" type="file" class="form-control-file" name="anexo"
                           value="{{ old('anexo') }}" autofocus>
                    @if ($errors->has('anexo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('anexo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <button id="btnCadastrarNoticia" type="button" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>

        </fieldset>
    </form>
    </div>
    <div class="col-md-6">
        <h2>Últimas Notícias</h2>
        <ul id="ultimasNoticias">
            <li index="5">ahahahahahah</li>
            <li index="4">bbbbbbbbbb</li>
            <li index="3">ccccccccccc</li>
            <li index="2">ddddddddddddd</li>
            <li index="1">eeeeeeeeee</li>
        </ul>
    </div>
</div>
@endsection