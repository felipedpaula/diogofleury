@extends('cms.layouts.index')

@section('title', 'Galeria')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Nova Galeria</h1>

    <div class="row mb-4">
        <div class="col-12">
            <a href="/admin/galerias" class="btn btn-secondary">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
            </a>
        </div>
    </div>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <!-- CONTEÚDO -->
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.galerias.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Primeira Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input name="titulo" type="text" class="form-control" id="titulo">
                            <small class="text-danger">Recomendado assimilar ao nome do Projeto</small>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <textarea name="descricao" id="descricao" cols="30" rows="15" class="form-control texto-grande"></textarea>
                        </div>
                    </div>

                    <!-- Segunda Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <label for="imagens">Imagens:</label>
                        <div class="alert alert-primary">
                            Você poderá adicionar as imagens dessa nova galeria depois de salvar.
                        </div>
                    </div>
                </div>

                <!-- Botão de Submissão -->
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>

@endsection
