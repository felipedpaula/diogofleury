<?php

namespace App\Http\Controllers\CmsControllers;

use App\Http\Controllers\Controller;
use App\Models\CategoriaDestaque;
use App\Models\Destaque;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DestaqueController extends Controller
{
    private $dadosPagina;
    private $categoriaDestaques;
    private $destaque;

    public function __construct() {
        $this->categoriaDestaques = new CategoriaDestaque();
        $this->destaque = new Destaque();
    }

    public function indexCategoria() {
        $this->dadosPagina['categorias'] = $this->categoriaDestaques->getCategoriasDestaquePaginadas();
        return view('cms.paginas.destaques.indexCategoria',$this->dadosPagina);
    }

    public function index(Request $request){
        $idCategoria = $request->id;
        $this->dadosPagina['destaques'] = $this->destaque->getDestaquesByCategoriaId($idCategoria);

        return view('cms.paginas.destaques.index',$this->dadosPagina);
    }

    public function create() {
        $this->dadosPagina['destaqueCategorias'] = CategoriaDestaque::all();
        return view('cms.paginas.destaques.create', $this->dadosPagina);
    }

    public function store(Request $request) {
        $data = $request->only([
            'categoria_id',
            'titulo',
            'subtitulo',
            'conteudo',
            'url_link',
            'txt_link',
            'date_start',
            'date_end',
            'ordem',
            'status',
        ]);

        $rules = [
            'categoria_id' => ['required', 'numeric'],
            'titulo' => ['required', 'string', 'max:255'],
            'subtitulo' => ['required', 'string', 'max:255'],
            'conteudo' => ['nullable', 'string'],
            'url_link' => ['nullable', 'string' , 'max:255'],
            'txt_link' => ['nullable', 'string' , 'max:255'],
            'date_start' => ['nullable', 'date'],
            'date_end' => ['nullable', 'date'],
            'ordem' => ['nullable'],
            'status' => ['required', 'in:0,1'],
        ];

        if($request->file('img_src')){
            $path =  Storage::disk('public')->put('/images', $request->file('img_src'));
            $data['img_src']= Storage::url($path);

        }else{
            $data['img_src']= 'assets/site/images/main-slider/slider-2.jpg';
        }

        if($request->file('video_src')){
            $path =  Storage::disk('public')->put('/videos', $request->file('video_src'));
            $data['video_src']= Storage::url($path);
        }

        if($request->date_start){
            $date_start = \DateTime::createFromFormat('d/m/Y H:i:s', $request->date_start.':00');
            $data['date_start'] = $date_start->format('Y-m-d H:i:s');
        }

        if($request->date_end){
            $date_end = \DateTime::createFromFormat('d/m/Y H:i:s', $request->date_end.':00');
            $data['date_end'] = $date_end->format('Y-m-d H:i:s');
        }

        $validator = Validator::make($data, $rules);
        if($validator->fails()) {
            return redirect()->route('admin.destaques.create')
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $destaque = new Destaque([
                'categoria_id' => $data['categoria_id'],
                'titulo' => $data['titulo'],
                'subtitulo' => $data['subtitulo'],
                'conteudo' => $request->conteudo ? $data['conteudo'] : null,
                'url_link' => $data['url_link'],
                'txt_link' => $data['txt_link'],
                'date_start' => $request->date_start ? $data['date_start'] : null,
                'date_end' => $request->date_end ? $data['date_end'] : null,
                'ordem' => $request->ordem ? $data['ordem'] : null,
                'status' => $data['status'],
                'img_src' => $data['img_src'],
                'video_src' => $data['video_src']
            ]);
            $destaque->save();

            return redirect()->route('admin.destaques.index', ['id' => $data['categoria_id']])->with('success', 'Destaque criado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('admin.destaques.create')->with('errors', 'Ocorreu um erro ao criar o Destaque. Por favor, tente novamente.');
        }
    }

    public function edit(Request $request) {
        $idDestaque = $request->id;
        $destaque = Destaque::findOrFail($idDestaque);
        $destaqueCategorias = CategoriaDestaque::all();
        $this->dadosPagina = [
            'destaque' => $destaque,
            'destaqueCategorias' => $destaqueCategorias,
        ];

        return view('cms.paginas.destaques.edit', $this->dadosPagina);
    }

    public function update(Request $request, $id) {
        $destaque = Destaque::findOrFail($id);

        $data = $request->only([
            'categoria_id',
            'titulo',
            'subtitulo',
            'conteudo',
            'url_link',
            'txt_link',
            'date_start',
            'date_end',
            'order',
            'status',
        ]);

        $rules = [
            'categoria_id' => ['required', 'numeric'],
            'titulo' => ['required', 'string', 'max:255'],
            'subtitulo' => ['required', 'string', 'max:255'],
            'conteudo' => ['nullable'],
            'url_link' => ['nullable', 'string' , 'max:255'],
            'txt_link' => ['nullable', 'string' , 'max:255'],
            'date_start' => ['nullable', 'date'],
            'date_end' => ['nullable', 'date'],
            'order' => ['nullable'],
            'status' => ['required', 'in:0,1'],
        ];

        // Verificar se um novo arquivo foi enviado
        if($request->hasFile('img_src')) {
            // Remover a imagem anterior (opcional)
            $existingImage = $destaque->img_src;
            if ($existingImage) {
                Storage::disk('public')->delete($existingImage);
            }
            // Armazenar a nova imagem
            $path = Storage::disk('public')->put('/images', $request->file('img_src'));
            $data['img_src'] = Storage::url($path);
        }else{
            // Caso contrário, manter a imagem existente
            unset($data['img_src']);
        }

        if($request->date_start){
            $date_start = \DateTime::createFromFormat('d/m/Y H:i:s', $request->date_start.':00');
            $data['date_start'] = $date_start->format('Y-m-d H:i:s');
        }

        if($request->date_end){
            $date_end = \DateTime::createFromFormat('d/m/Y H:i:s', $request->date_end.':00');
            $data['date_end'] = $date_end->format('Y-m-d H:i:s');
        }

        $validator = Validator::make($data, $rules);
        if($validator->fails()) {
            return redirect()->route('admin.destaques.edit', ['id' => $id])
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $destaque->update($data);
            return redirect()->route('admin.destaques.index', ['id' => $destaque->categoria_id])->with('success', 'Destaque alterado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.destaques.edit', ['id' => $id])
            ->with('error', 'Ocorreu um erro ao atualizar o Destaque. Por favor, tente novamente.');

        }
    }

    public function delete($id) {
        try {
            $destaque = Destaque::findOrFail($id);
            $destaque->delete();
            return redirect()->route('admin.destaques.index', ['id' => $id])->with('success', 'Destaque excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('admin.destaques.index', ['id' => $id])->with('error', 'Erro ao tentar excluir o Destaque.');
        }

    }
}
