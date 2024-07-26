<?php

namespace App\Http\Controllers\CmsControllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\UsuarioTipo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class UsuariosController extends Controller
{

    private $dadosPagina;
    private $usuario;

    public function __construct() {
        $this->usuario = new Usuario();
    }

    public function index() {
        $this->dadosPagina['usuarios'] = $this->usuario->getUsuariosPaginados(10);
        return view('cms.paginas.usuarios.index', $this->dadosPagina);
    }

    public function create() {
        $this->dadosPagina['tipos'] = UsuarioTipo::all();
        return view('cms.paginas.usuarios.create', $this->dadosPagina);
    }

    public function store(Request $request) {
        $data = $request->only([
            'nome',
            'email',
            'password',
            'tipo_id',
            'cpf',
            'nasc',
            'tel',
            'status',
        ]);

        $rules = [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:usuarios,email'],
            'password' => ['required', 'string', 'min:8'],
            'tipo_id' => ['required', 'integer', 'in:1,2,3,4'],
            'cpf' => ['nullable', 'string', 'unique:usuarios,cpf'],
            'nasc' => ['nullable', 'date', 'before:today'],
            'tel' => ['nullable', 'string'],
            'status' => ['required', 'in:0,1'],
        ];

        $validator = Validator::make($data, $rules);

        if($validator->fails()) {
            return redirect()->route('admin.usuarios.create')
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $usuario = Usuario::firstOrNew(['email' => $data['email']]);
            if (!$usuario->exists) {
                $usuario->nome = $data['nome'];
                $usuario->tipo_id = $data['tipo_id'];
                $usuario->password = Hash::make($data['password']);
                $usuario->cpf = $data['cpf'];
                $usuario->nasc = $data['nasc'];
                $usuario->tel = $data['tel'];
                $usuario->status = $data['status'];
                $usuario->save();
                return redirect()->route('admin.usuarios.index')->with('success', 'Usuário criado com sucesso!');
            } else {
                return redirect()->route('admin.usuarios.create')->with('error', 'E-mail já está em uso.');
            }

        } catch (\Exception $e) {
            return redirect()->route('admin.usuarios.create')->with('errors', 'Ocorreu um erro ao criar o usuário. Por favor, tente novamente.');
        }
    }

    public function edit(Request $request) {
        $idUsuario = $request->id;
        $user = Usuario::findOrFail($idUsuario);

        if ($user->nasc !== null) {
            $user->nasc = Carbon::parse($user->nasc)->format('Y-m-d');
        }

        $this->dadosPagina = [
            'usuario' => $user,
            'tipos' => UsuarioTipo::all(),
        ];

        return view('cms.paginas.usuarios.edit', $this->dadosPagina);
    }

    public function update(Request $request, $id) {
        $usuario = Usuario::findOrFail($id);

        $data = $request->only([
            'nome',
            'email',
            'password',
            'tipo_id',
            'cpf',
            'nasc',
            'tel',
            'status',
        ]);

        $rules = [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:usuarios,email,' . $usuario->id],
            'tipo_id' => ['required', 'integer', 'in:1,2,3,4'],
            'cpf' => ['nullable', 'string', 'unique:usuarios,cpf,' . $usuario->id],
            'nasc' => ['nullable', 'date', 'before:today'],
            'tel' => ['nullable', 'string'],
            'status' => ['required', 'in:0,1'],
        ];

        if ($request->has('password') && !empty($data['password'])) {
            $rules['password'] = ['string', 'min:8'];
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.usuarios.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $usuario->nome = $data['nome'];
            $usuario->email = $data['email'];
            if (!empty($data['password'])) {
                $usuario->password = Hash::make($data['password']);
            }
            $usuario->tipo_id = $data['tipo_id'];
            $usuario->cpf = $data['cpf'];
            $usuario->nasc = $data['nasc'];
            $usuario->tel = $data['tel'];
            $usuario->status = $data['status'];
            $usuario->save();

            return redirect()->route('admin.usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.usuarios.edit', ['id' => $id])
                ->with('error', 'Ocorreu um erro ao atualizar o usuário. Por favor, tente novamente.');
        }
    }

    public function delete(Request $request) {
        $idUsuario = $request->id;
        $user = Usuario::find($idUsuario);
        if (!$user) {
            return redirect()->route('admin.usuarios.index')->with('error', 'Usuário não encontrado.');
        }
        try {
            $user->delete();
            return redirect()->route('admin.usuarios.index')->with('success', 'Usuário excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('admin.usuarios.index')->with('error', 'Erro ao tentar excluir o usuário.');
        }
    }


}
