@extends('cms.layouts.index')

@section('title', 'Destaques')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Destaques</h1>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <div class="row mb-4">
        <div class="col-6 d-flex"></div>
        <div class="col-6 text-right">
            <a href="{{route('admin.destaques.create')}}" class="btn btn-primary" type="button">+ Novo Destaque</a>
        </div>
    </div>

    <!-- CONTEÚDO -->
    <div class="card">
        @if (isset($categorias) && count($categorias) > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Tamanho imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $item)
                <tr>
                    <td>{{$item->titulo}}</td>
                    <td>{{$item->descricao}}</td>
                    <td>{{$item->img_size}}</td>
                    <td width=50><a href="{{route('admin.destaques.index', ['id' => $item->id])}}" class="btn btn-sm btn-warning">Abrir</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginacao-centralizada">
            {{$categorias->links('pagination::bootstrap-4')}}
        </div>

        @else
        <div class="card-body">
            Nenhum item para listagem.
        </div>
        @endif
    </div>

@endsection
