@extends('cms.layouts.index')

@section('title', 'Galerias')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Galerias</h1>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <div class="row mb-4">
        <div class="col-6 d-flex">
            <form class="form-inline" id="formBusca" method="get" action="{{Request::url()}}" >
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Buscar Galeria" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>

                @if(request()->filled('search'))
                <a style="margin-left:10px" href="{{route('admin.galerias.index')}}" class="btn btn-success my-2 my-sm-0" >Limpar Buscar</a>
                @endif
            </form>
        </div>
        <div class="col-6 text-right">
            <a href="{{route('admin.galerias.create')}}" class="btn btn-primary" type="button">+ Nova galeria</a>
        </div>
    </div>

    <!-- CONTEÚDO -->
    <div class="card">
        @if (isset($galerias) && count($galerias) > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Título</th>
                    <th width=100>Ações</th>
                </tr>

                <tbody>
                    @foreach ($galerias as $galeria)
                    <tr>
                        <td>{{$galeria->titulo}}</td>
                        <td>
                            <a href="{{route('admin.galerias.edit', $galeria->id)}}" class="btn btn-sm btn-warning">Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>

        <div class="paginacao-centralizada">
            {{$galerias->links('pagination::bootstrap-4')}}
        </div>

        @else
        <div class="card-body">
            Nenhum item para listagem.
        </div>
        @endif
    </div>

@endsection
