@extends('cms.layouts.index')

@section('title', 'Destaque')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Editar Destaque</h1>

    <div class="row mb-4">
        <div class="col-6">
            <a href="/admin/categorias-destaques" class="btn btn-secondary">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
            </a>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-danger delete_button">
                Excluir Destaque <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <!-- CONTEÚDO -->
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.destaques.update',['id' => $destaque->id])}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <!-- Primeira Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="categoria_id">Categoria | Tamanho imagem</label>
                            <select name="categoria_id" class="form-control" id="categoria_id">
                                @foreach ($destaqueCategorias as $categoria)
                                <option value="{{$categoria->id}}"
                                    {{isset($destaque->categoria_id) === true && $destaque->categoria_id === $categoria->id ? 'selected="selected"' : ''}}
                                >
                                {{$categoria->titulo}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input name="titulo" type="text" class="form-control" id="titulo"
                            value="{{isset($destaque->titulo) === true ? $destaque->titulo : ''}}"
                            >
                        </div>

                        <div class="form-group">
                            <label for="subtitulo">Subtítulo</label>
                            <input name="subtitulo" type="text" class="form-control" id="subtitulo"
                            value="{{isset($destaque->subtitulo) === true ? $destaque->subtitulo : ''}}"
                            >
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="1" {{isset($destaque->status) === true && $destaque->status === 1 ? 'selected="selected"' : ''}}>Ativado</option>
                                <option value="0" {{isset($destaque->status) === true && $destaque->status === 0 ? 'selected="selected"' : ''}}>Bloqueado</option>
                            </select>
                        </div>
                    </div>

                    <!-- Segunda Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="description">Texto do Link</label>
                            <input name="txt_link" type="text" class="form-control" id="txt_link" value="{{isset($destaque->txt_link) === true ? $destaque->txt_link : ''}}">
                        </div>

                        <div class="form-group">
                            <label for="url_link">Link</label>
                            <input name="url_link" type="text" class="form-control" id="url_link"
                            value="{{isset($destaque->url_link) === true ? $destaque->url_link : ''}}"
                            >
                        </div>

                        <div class="form-group">
                            <label for="img_src">Imagem</label>
                            <input type="file" name="img_src" class="form-control" id="img_src">
                            <img src="{{asset($destaque->img_src)}}" alt="preview" width="220px" height="300px" id="preview" class="img-fluid"/>
                        </div>
                        <div class="mt-3 alert alert-primary">
                            <small>Priorize imagens no formato WEPB para melhor desempenho do site. Você pode converter suas imagens no site:
                            <a target="_blank" href="https://convertio.co/pt/jpg-webp/">Convertio</a></small>
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

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="publicidadeExcluirForm" method="POST" action="{{route('admin.destaques.delete', ['id' => $destaque->id])}}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Excluir Destaque</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        Você tem <b>certeza</b> que deseja excluir o Destaque<b>"<span>{{$destaque->titulo}}</span>"</b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </div>
                </form>
            </div>
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
