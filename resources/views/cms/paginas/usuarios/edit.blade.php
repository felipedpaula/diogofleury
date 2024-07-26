@extends('cms.layouts.index')

@section('title', 'Usuários')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edtar usuário #{{$usuario->id}} - {{$usuario->nome}}</h1>

    <div class="row mb-4">
        <div class="col-6">
            <a href="/admin/usuarios" class="btn btn-secondary">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
            </a>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-danger delete_button">
                Excluir Usuário <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <!-- CONTEÚDO -->
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.usuarios.update', ['id' => $usuario->id])}}" method="POST">
                @csrf
                <div class="row">
                    <!-- Primeira Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input name="nome" type="text" class="form-control" id="nome" value="{{$usuario->nome}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" id="email" value="{{$usuario->email}}">
                        </div>
                        <div class="form-group">
                            <label for="tipo_id">Tipo de Usuário</label>
                            <select name="tipo_id" class="form-control" id="tipo_id">
                                @foreach ($tipos as $tipo)
                                <option value="{{$tipo->id}}"
                                    {{isset($usuario->tipo_id) === true && $usuario->tipo_id === $tipo->id ? 'selected="selected"' : ''}}
                                >
                                {{$tipo->titulo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input name="password" type="password" class="form-control" id="password">
                        </div>
                    </div>

                    <!-- Segunda Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input name="cpf" type="text" class="form-control" id="cpf" value="{{$usuario->cpf}}">
                        </div>
                        <div class="form-group">
                            <label for="nasc">Data de Nascimento</label>
                            <input name="nasc" type="date" class="form-control" id="nasc" value="{{ $usuario->nasc }}">
                        </div>
                        <div class="form-group">
                            <label for="tel">Telefone</label>
                            <input name="tel" type="tel" class="form-control" id="telefone" value="{{$usuario->tel}}">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="statusUsuario">
                                <option value="1" {{ $usuario->status == 1 ? 'selected' : '' }}>Ativado</option>
                                <option value="0" {{ $usuario->status == 0 ? 'selected' : '' }}>Bloqueado</option>
                            </select>
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
                <form id="publicidadeExcluirForm" method="POST" action="{{route('admin.usuarios.delete', ['id' => $usuario->id])}}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Excluir Usuário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        Você tem <b>certeza</b> que deseja excluir o Usuário <b>"<span>{{$usuario->nome}}</span>"</b>?
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
