@extends('cms.layouts.index')

@section('title', 'Destaques')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Destaques</h1>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <div class="row mb-4">
        <div class="col-6 d-flex">
            <a href="/admin/categorias-destaques" class="btn btn-secondary">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
            </a>
        </div>
        <div class="col-6 text-right">
            <a href="{{route('admin.destaques.create')}}" class="btn btn-primary" type="button">+ Novo Destaque</a>
        </div>
    </div>

    <!-- CONTEÚDO -->
    <div class="card">
        @if (isset($destaques) && count($destaques) > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Subtítulo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($destaques as $item)
                <tr>
                    <td>{{$item->titulo}}</td>
                    <td>{{$item->subtitulo}}</td>
                    <td width=50><a href="{{route('admin.destaques.edit', ['id' => $item->id])}}" class="btn btn-sm btn-warning">Editar</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginacao-centralizada">
            {{$destaques->links('pagination::bootstrap-4')}}
        </div>

        @else
        <div class="card-body">
            Nenhum item para listagem.
        </div>
        @endif
    </div>

@endsection
