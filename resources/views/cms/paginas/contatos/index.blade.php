@extends('cms.layouts.index')

@section('title', 'Contato')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Mensagens de Contato</h1>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <!-- CONTEÚDO -->
    <div class="row mb-4">
        <div class="col-6 d-flex">
            Mensagens enviadas da página de contato do site: <a target="_blank" href="/contato">&nbsp;Contato</a>
        </div>
        <div class="col-6 text-right">
            @if (isset($contatos) && count($contatos) > 0)
            <button class="btn btn-danger btn-icon-split delete_button">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Limpar caixa de entrada</span>
            </button>
            @endif
        </div>
    </div>

    <div class="card">
        @if (isset($contatos) && count($contatos) > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th width=70>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($contatos as $contato)
                <tr>
                    <td>{{$contato->nome}}</td>
                    <td>{{$contato->email}}</td>
                    <td>
                        <a href="{{route('admin.contatos.edit', $contato->id)}}" class="btn btn-sm btn-primary">Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginacao-centralizada">
            {{$contatos->links('pagination::bootstrap-4')}}
        </div>

        @else
        <div class="card-body">
            Nenhuma mensagem para listagem.
        </div>
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="publicidadeExcluirForm" method="POST" action="{{route('admin.contatos.deleteAll')}}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Limpar caixa de entrada</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        Você tem <b>certeza</b> que deseja excluir todas as mensagens<b></b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
