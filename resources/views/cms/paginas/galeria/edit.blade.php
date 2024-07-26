@extends('cms.layouts.index')

@section('title', 'Galeria')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Editar Galeria: {{$galeria->titulo}}</h1>

    <div class="row mb-4">
        <div class="col-6">
            <a href="/admin/galerias" class="btn btn-secondary">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
            </a>
        </div>

        <div class="col-6 text-right">
            <button class="btn btn-danger delete_button">
                Excluir Galeria <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <!-- CONTEÚDO -->
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.galerias.update', ['id' => $galeria->id])}}" method="POST" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="row">
                    <!-- Primeira Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input value="{{$galeria->titulo}}" name="titulo" type="text" class="form-control" id="titulo">
                            <small class="text-danger">Recomendado assimilar ao nome do Projeto</small>
                        </div>
                        <div class="form-group">
                            <label value="{{$galeria->descricao}}" for="descricao">Descrição:</label>
                            <textarea name="descricao" id="descricao" cols="30" rows="15" class="form-control texto-grande"></textarea>
                        </div>
                    </div>

                    <!-- Segunda Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <label for="imagens">Imagens da Galeria:</label>
                        <div class="col-12 px-0">
                            <div class="lista-img-galeria ">
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#imagemModal" style="width:100px;height:100px;font-size:50px">+</button>
                                @foreach ($imagens as $imagem)
                                <div class="img-galeria">
                                    <img width="100px" height="100px" src="{{$imagem->src}}" alt="{{$imagem->img_titulo}}">
                                    <a href="{{ route('admin.galerias.remove', ['id' => $galeria->id, 'id_imagem' => $imagem->id]) }}" class="lixeira-layer" onclick="return confirm('Tem certeza que deseja excluir esta imagem?')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="alert alert-primary mt-3">
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

    <!-- Modal Adiciona Imagem -->
    <div class="modal fade" id="imagemModal" tabindex="-1" role="dialog" aria-labelledby="imagemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagemModalLabel">Adicionar Imagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.galerias.add', ['id' => $galeria->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- {{ method_field('PUT') }} --}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="img_titulo">Título</label>
                            <input type="text" class="form-control" id="img_titulo" name="img_titulo" placeholder="Título da imagem">
                        </div>
                        <div class="form-group">
                            <label for="src">Escolher imagem</label>
                            <input type="file" class="form-control-file" id="src" name="src">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar Imagem</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="publicidadeExcluirForm" method="POST" action="{{route('admin.galerias.delete', ['id' => $galeria->id])}}">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Excluir Galeria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        Você tem <b>certeza</b> que deseja excluir a Galeria<b>"<span>{{$galeria->titulo}}</span>"</b>?
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
        document.getElementById("img_default").addEventListener("change", readImage, false);
    </script>

@endsection
