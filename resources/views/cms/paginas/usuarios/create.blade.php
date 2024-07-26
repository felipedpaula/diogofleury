@extends('cms.layouts.index')

@section('title', 'Usuários')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Novo usuário</h1>

    <div class="row mb-4">
        <div class="col-12">
            <a href="/admin/usuarios" class="btn btn-secondary">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
            </a>
        </div>
    </div>

    <!-- ALERTAS -->
    @include('cms.components.alerts')

    <!-- CONTEÚDO -->
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.usuarios.store')}}" method="POST">
                @csrf
                <div class="row">
                    <!-- Primeira Coluna -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input name="nome" type="text" class="form-control" id="nome">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="tipoUsuario">Tipo de Usuário</label>
                            <select name="tipo_id" class="form-control" id="tipoUsuario">
                                @foreach ($tipos as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->titulo}}</option>
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
                            <input name="cpf" type="text" class="form-control" id="cpf">
                        </div>
                        <div class="form-group">
                            <label for="nasc">Data de Nascimento</label>
                            <input name="nasc" type="date" class="form-control" id="nasc">
                        </div>
                        <div class="form-group">
                            <label for="tel">Telefone</label>
                            <input name="tel" type="tel" class="form-control" id="telefone">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="statusUsuario">
                                <option value="1">Ativado</option>
                                <option value="0">Bloqueado</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Botão de Submissão -->
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>


@endsection
