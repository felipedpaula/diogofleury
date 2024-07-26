@extends('cms.layouts.index')

@section('title', 'Usuários')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Usuários</h1>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <!-- CONTEÚDO -->
    <div class="row mb-4">
        <div class="col-md-8 d-flex">
            <form class="form-inline" id="formBusca" method="get" action="{{Request::url()}}" >
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Buscar Usuário" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>

                @if(request()->filled('search'))
                <a style="margin-left:10px" href="{{route('admin.usuarios.index')}}" class="btn btn-success my-2 my-sm-0" >Limpar Buscar</a>
                @endif
            </form>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{route('admin.usuarios.create')}}" class="btn btn-primary" type="button">+ Novo usuário</a>
        </div>
    </div>

    <div class="card">
        @if (isset($usuarios) && count($usuarios) > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width=100>Tipo</th>
                    <th>Nome</th>
                    <th width=100>Ações</th>
                </tr>

                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->tipo->titulo}}</td>
                        <td>{{$usuario->nome}}</td>
                        <td>
                            <a href="{{route('admin.usuarios.edit', $usuario->id)}}" class="btn btn-sm btn-warning">Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>

        <div class="paginacao-centralizada">
            {{$usuarios->links('pagination::bootstrap-4')}}
        </div>

        @else
        <div class="card-body">
            Nenhum item para listagem.
        </div>
        @endif
    </div>

@endsection
