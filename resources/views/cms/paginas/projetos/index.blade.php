@extends('cms.layouts.index')

@section('title', 'Projetos')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Projetos</h1>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <div class="row mb-4">
        <div class="col-md-8 d-flex">
            <form class="form-inline" id="formBusca" method="get" action="{{Request::url()}}" >
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Buscar Projeto" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>

                @if(request()->filled('search'))
                <a style="margin-left:10px" href="{{route('admin.projetos.index')}}" class="btn btn-success my-2 my-sm-0" >Limpar Buscar</a>
                @endif
            </form>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{route('admin.projetos.create')}}" class="btn btn-primary" type="button">+ Novo projeto</a>
        </div>
    </div>

    <!-- CONTEÚDO -->
    <div class="card">
        @if (isset($projetos) && count($projetos) > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Título</th>
                    <th width=100>Ações</th>
                </tr>

                <tbody>
                    @foreach ($projetos as $projeto)
                    <tr>
                        <td>{{$projeto->titulo}}</td>
                        <td>
                            <a href="{{route('admin.projetos.edit', $projeto->id)}}" class="btn btn-sm btn-warning">Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>

        <div class="paginacao-centralizada">
            {{$projetos->links('pagination::bootstrap-4')}}
        </div>

        @else
        <div class="card-body">
            Nenhum item para listagem.
        </div>
        @endif
    </div>


@endsection
