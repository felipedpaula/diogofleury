@extends('cms.layouts.index')

@section('title', 'Destaque')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Novo Destaque</h1>

    <div class="row mb-4">
        <div class="col-12">
            <a href="/admin/categorias-destaques" class="btn btn-secondary">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
            </a>
        </div>
    </div>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <!-- CONTEÚDO -->
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.destaques.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Primeira Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="categoria_id">Categoria | Tamanho imagem</label>
                            <select name="categoria_id" class="form-control" id="categoria_id">
                                <option>Selecione a categoria</option>
                                @foreach ($destaqueCategorias as $categoria)
                                <option data-slug="{{$categoria->id}}" value="{{$categoria->id}}">{{$categoria->titulo}} | {{$categoria->img_size}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input name="titulo" type="text" class="form-control" id="titulo">
                        </div>

                        <div class="form-group">
                            <label for="subtitulo">Subtítulo</label>
                            <input name="subtitulo" type="text" class="form-control" id="subtitulo">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="1">Ativado</option>
                                <option value="0">Bloqueado</option>
                            </select>
                        </div>
                    </div>

                    <!-- Segunda Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="description">Texto do Link</label>
                            <input name="txt_link" type="text" class="form-control" id="txt_link">
                        </div>

                        <div class="form-group">
                            <label for="url_link">Link</label>
                            <input name="url_link" type="text" class="form-control" id="url_link">
                        </div>

                        <div class="form-group">
                            <label for="img_src">Imagem</label>
                            <input type="file" name="img_src" class="form-control" id="img_src">
                            <img src="#" alt="preview" width="220px" height="300px" id="preview" class="img-fluid"/>
                        </div>

                        <div class="mt-3 alert alert-primary">
                            <small>Priorize imagens no formato WEPB para melhor desempenho do site. Você pode converter suas imagens no site:
                            <a target="_blank" href="https://convertio.co/pt/jpg-webp/">Convertio</a></small>
                        </div>

                        <div class="form-group">
                            <label for="video_src">Vídeo</label>
                            <input type="file" name="video_src" class="form-control" id="video_src">
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
