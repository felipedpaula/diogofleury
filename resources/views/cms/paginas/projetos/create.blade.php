@extends('cms.layouts.index')

@section('title', 'Novo Projeto')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Novo Projeto</h1>

    <div class="row mb-4">
        <div class="col-12">
            <a href="/admin/projetos" class="btn btn-secondary">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
            </a>
        </div>
    </div>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <!-- CONTEÚDO -->
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.projetos.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Primeira Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input name="titulo" type="text" class="form-control" id="titulo">
                        </div>
                        <div class="form-group">
                            <label for="resumo">Resumo:</label>
                            <input name="resumo" type="text" class="form-control" id="resumo">
                        </div>
                        <div class="form-group">
                            <label for="img_src">Imagem de destaque:</label>
                            <img  src="" alt="preview" width="220px" height="300px" id="preview" class="img-fluid"/>
                            <input type="file" name="img_src" class="form-control" id="img_src">
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" class="form-control" id="statusUsuario">
                                <option value="1">Ativado</option>
                                <option value="0">Bloqueado</option>
                            </select>
                        </div>
                    </div>

                    <!-- Segunda Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="conteudo">Texto:</label>
                            <textarea name="conteudo" id="conteudo" cols="30" rows="15" class="form-control texto-grande"></textarea>
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

    <script>
        function readImage() {
            if (this.files && this.files[0]) {
                var file = new FileReader();
                file.onload = function(e) {
                    document.getElementById("preview").src = e.target.result;
                };
                file.readAsDataURL(this.files[0]);
            }
        }
        document.getElementById("img_src").addEventListener("change", readImage, false);
    </script>


@endsection
