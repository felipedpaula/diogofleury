<?php

namespace App\Http\Controllers\CmsControllers;

use App\Http\Controllers\Controller;
use App\Models\ImageProjects;
use App\Models\Projeto;
use App\Models\Galeria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProjetosController extends Controller
{
    private $dadosPagina;
    private $projeto;
    private $galeria;

    public function __construct(){
        $this->projeto = new Projeto();
        $this->galeria = new Galeria();
    }

    public function index(){
        $this->dadosPagina['projetos'] = $this->projeto->getProjetosPaginados(10);
        return view('cms.paginas.projetos.index', $this->dadosPagina);
    }

    public function create(){
        return view('cms.paginas.projetos.create');
    }

    public function store(Request $request){

        $data = $request->only([
            'tipo',
            'titulo',
            'resumo',
            'conteudo',
            'img_src',
            'status',
        ]);

        $rules = [
            'tipo' => ['numeric', 'required', 'in:1,2'],
            'titulo' => ['required', 'string', 'max:255'],
            'resumo' => ['nullable', 'string'],
            'conteudo' => ['nullable', 'string'],
            'status' => ['required', 'in:0,1'],
        ];

        if($request->file('img_src')){
            $path =  Storage::disk('public')->put('/images', $request->file('img_src'));
            $data['img_src']= Storage::url($path);

        }else{
            $data['img_src']= null ;
        }

        $data['slug'] = Str::slug($request->titulo);
        $validator = Validator::make($data, $rules);
        if($validator->fails()) {
            return redirect()->route('admin.projetos.create')
            ->withErrors($validator)
            ->withInput();
        }

        try {

            $project = new Projeto([
                'tipo' => $data['tipo'],
                'titulo' => $data['titulo'],
                'slug' => $data['slug'],
                'resumo' =>  $data['resumo'],
                'conteudo' =>  $data['conteudo'],
                'status' => $data['status'],
                'img_src' => $data['img_src']
            ]);

            $project->save();

            return redirect()->route('admin.projetos.index')->with('success', 'Projeto criado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('admin.projetos.create')->with('errors', 'Ocorreu um erro ao criar o Projeto. Por favor, tente novamente.');
        }
    }

    public function edit(Request $request){
        $idProject = $request->id;
        $projeto = Projeto::findOrFail($idProject);
        $galerias = $this->galeria->getGalerias();

        $this->dadosPagina = [
            'projeto' => $projeto,
            'galerias' => $galerias
        ];

        return view('cms.paginas.projetos.edit', $this->dadosPagina);
    }

    public function update(Request $request, $id){
        $projeto = Projeto::findOrFail($id);

        $data = $request->only([
            'tipo',
            'titulo',
            'resumo',
            'conteudo',
            'img_src',
            'video_src',
            'galeria_id',
            'status',
        ]);

        $rules = [
            'tipo' => ['numeric', 'required', 'in:1,2'],
            'titulo' => ['required', 'string', 'max:255'],
            'resumo' => ['nullable', 'string'],
            'conteudo' => ['nullable', 'string'],
            'status' => ['required', 'in:0,1'],
        ];

        if ($request->hasFile('img_src')) {
            $path = Storage::disk('public')->put('/images', $request->file('img_src'));
            $data['img_src'] = Storage::url($path);
        } else {
            unset($data['img_src']); // Não substituir a imagem se nenhuma nova for enviada
        }

        if ($request->hasFile('video_src')) {
            $path = Storage::disk('public')->put('/videos', $request->file('video_src'));
            $data['video_src'] = Storage::url($path);
        } else {
            unset($data['video_src']);
        }


        $data['slug'] = Str::slug($request->titulo);
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->route('admin.projetos.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $projeto->update($data);

            return redirect()->route('admin.projetos.edit', ['id' => $id])->with('success', 'Projeto atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.projetos.edit', ['id' => $id])->with('error', 'Ocorreu um erro ao atualizar o Projeto. Por favor, tente novamente.');
        }
    }

    public function delete($id){
        $projeto = Projeto::find($id);
        if (!$projeto) {
            return redirect()->route('admin.projetos.index')->with('error', 'Projeto não encontrado.');
        }

        try {
            $projeto->delete();

            return redirect()->route('admin.projetos.index')->with('success', 'Projeto removido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.projetos.index')->with('error', 'Ocorreu um erro ao tentar remover o Projeto. Por favor, tente novamente.');
        }
    }

}
