<?php

namespace App\Http\Controllers\CmsControllers;

use App\Http\Controllers\Controller;
use App\Models\Sobre;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Exception;

class SobreController extends Controller
{
    private $dadosPagina;
    private $sobre;

    public function __construct() {
        $this->sobre = new Sobre();
    }

    public function index() {
        $this->dadosPagina['sobre'] = Sobre::findOrFail(1);
        return view('cms.paginas.sobre.index', $this->dadosPagina);
    }

    public function update(Request $request) {
        $id = $request->id;

        $sobre = Sobre::findOrFail($id);

        $data = $request->only([
            'titulo',
            'conteudo',
            'img_src',
            'status',
        ]);

        $rules = [
            'titulo' => ['required', 'string', 'max:255'],
            'conteudo' => ['required', 'string'],
            'status' => ['required', 'in:0,1'],
        ];

        if ($request->hasFile('img_src')) {
            $path = Storage::disk('public')->put('/images', $request->file('img_src'));
            $data['img_src'] = Storage::url($path);
        } else {
            unset($data['img_src']); // Não substituir a imagem se nenhuma nova for enviada
        }

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->route('admin.sobre.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $sobre->update($data);

            return redirect()->route('admin.sobre.index')->with('success', 'Página Sobre atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.sobre.index')->with('error', 'Ocorreu um erro ao atualizar o Projeto. Por favor, tente novamente.');
        }

    }
}
