@extends('cms.layouts.index')

@section('title', 'Sobre')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Sobre mim (Página)</h1>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <!-- CONTEÚDO -->
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.sobre.update', ['id' => $sobre->id])}}" method="POST" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <input name="titulo" type="text" class="form-control" id="titulo" value="{{$sobre->titulo}}">
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" class="form-control" id="statusUsuario">
                                <option value="1" {{isset($sobre->status) === true && $sobre->status === 1 ? 'selected="selected"' : ''}}>Ativado</option>
                                <option value="0" {{isset($sobre->status) === true && $sobre->status === 0 ? 'selected="selected"' : ''}}>Bloqueado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="conteudo" id="conteudo" cols="30" rows="8" class="form-control texto-grande">{{$sobre->conteudo}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <input type="file" name="img_src" class="form-control mb-3" id="img_src">
                            <label for="img_src">Imagem de destaque:</label><br>
                            <img  src="{{asset($sobre->img_src)}}" alt="preview" width="220px" height="300px" id="preview" class="img-fluid"/>
                        </div>
                        <!-- Botão de Submissão -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
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
