@extends('cms.layouts.index')

@section('title', 'Editar Projeto')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Editar Projeto: {{$projeto->titulo}}</h1>

    <div class="row mb-4">
        <div class="col-6">
            <a href="/admin/projetos" class="btn btn-secondary">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
            </a>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-danger delete_button">
                Excluir Projeto <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <!-- CONTEÚDO -->
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.projetos.update', ['id' => $projeto->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Primeira Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="tipo">Tipo:</label>
                            <select name="tipo" class="form-control" id="tipo">
                                <option {{$projeto->tipo === 1 ? 'selected="selected"' : ''}} value="1">Foto</option>
                                <option {{$projeto->tipo === 2 ? 'selected="selected"' : ''}} value="2">Vídeo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input name="titulo" type="text" class="form-control" id="titulo" value="{{$projeto->titulo}}">
                        </div>

                        <div class="form-group">
                            <label for="galeria_id">Galeria:</label>
                            <select name="galeria_id" class="form-control" id="galeria_id">
                                @if (isset($galerias) && count($galerias) > 0)
                                <option value="">Selecione uma galeria</option>
                                @foreach ($galerias as $galeria)
                                <option value="{{$galeria->id}}"
                                    {{isset($projeto->galeria_id) === true && $projeto->galeria_id === $galeria->id ? 'selected="selected"' : ''}}
                                >
                                {{$galeria->titulo}}</option>
                                @endforeach
                                @else
                                <option value="">Não existem galerias</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" class="form-control" id="statusUsuario">
                                <option value="1" {{isset($projeto->status) === true && $projeto->status === 1 ? 'selected="selected"' : ''}}>Ativado</option>
                                <option value="0" {{isset($projeto->status) === true && $projeto->status === 0 ? 'selected="selected"' : ''}}>Bloqueado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="img_src">Thumb de destaque:</label><br>
                            <img  src="{{asset($projeto->img_src)}}" alt="preview" width="220px" height="300px" id="preview" class="img-fluid"/>
                            <input type="file" name="img_src" class="form-control" id="img_src">
                        </div>
                        @if ($projeto->tipo === 2)
                            <div class="form-group">
                                <label for="video_src">Vídeo</label><br>
                                <video id="video" width="300">
                                    <source src="{{ asset($projeto->video_src) }}" type="video/mp4">
                                </video>
                                <input type="file" name="video_src" class="form-control" id="video_src">
                            </div>
                        @endif
                    </div>

                    <!-- Segunda Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="resumo">Resumo:</label>
                            <input name="resumo" type="text" class="form-control" id="resumo" value="{{$projeto->resumo}}">
                        </div>
                        <div class="form-group">
                            <label for="conteudo">Texto:</label>
                            <textarea name="conteudo" id="conteudo" cols="30" rows="15" class="form-control texto-grande">{{$projeto->conteudo}}</textarea>
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
                <form id="publicidadeExcluirForm" method="POST" action="{{route('admin.projetos.delete', ['id' => $projeto->id])}}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Excluir Usuário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        Você tem <b>certeza</b> que deseja excluir o Projeto <b>"<span>{{$projeto->titulo}}</span>"</b>?
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
