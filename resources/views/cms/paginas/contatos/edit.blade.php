@extends('cms.layouts.index')

@section('title', 'Contato')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Mensagem de Contato</h1>

    <div class="row mb-4">
        <div class="col-6">
            <a href="/admin/contatos" class="btn btn-secondary">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
            </a>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-danger delete_button">
                Excluir mensagem <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <!-- CONTEÚDO -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Primeira Coluna -->
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <input readonly name="nome" type="text" class="form-control" id="titulo" value="{{$contato->nome}}">
                    </div>
                    <div class="form-group">
                        <input readonly name="email" type="email" class="form-control" id="email" value="{{$contato->email}}">
                    </div>
                    <div class="form-group">
                        <input readonly name="tel" type="text" class="form-control" id="tel" value="{{$contato->tel}}">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <textarea readonly name="mensagem" id="mensagem" cols="30" rows="8" class="form-control">{{$contato->mensagem}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="publicidadeExcluirForm" method="POST" action="{{route('admin.contatos.delete', ['id' => $contato->id])}}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Excluir Conteudo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        Você tem <b>certeza</b> que deseja excluir o contato de <b>"<span>{{$contato->nome}}</span>"</b>?
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
