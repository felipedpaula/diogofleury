<?php

namespace App\Http\Controllers\CmsControllers;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use Illuminate\Http\Request;
use Exception;

class ContatoController extends Controller
{
    private $dadosPagina;
    private $contato;

    public function __construct() {
        $this->contato = new Contato();
    }

    public function index() {
        $this->dadosPagina['contatos'] =  $this->contato->getContatosPaginados(10);
        return view('cms.paginas.contatos.index', $this->dadosPagina);
    }

    public function edit(Request $request) {
        $contato = Contato::findOrFail($request->id);

        $contato->status = true;
        $contato->save();

        $this->dadosPagina['contato'] = $contato;
        return view('cms.paginas.contatos.edit', $this->dadosPagina);
    }

    public function delete($id){
        $contato = Contato::findOrFail($id);
        try {
            $contato->delete();
            return redirect()->route('admin.contatos.index')->with('success', 'Contato excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('admin.contatos.index')->with('error', 'Erro ao tentar excluir o Contato.');
        }
    }

    public function deleteAll() {
        try {
            // Exclui todas as mensagens
            Contato::truncate();

            return redirect()->route('admin.contatos.index')->with('success', 'Todas as mensagens foram excluídas com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('admin.contatos.index')->with('error', 'Erro ao tentar excluir todas as mensagens.');
        }
    }
}
