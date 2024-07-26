<?php

namespace App\Http\Controllers\CmsControllers;

use App\Models\Galeria;
use App\Http\Controllers\Controller;
use App\Models\ImagemGaleria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GaleriasController extends Controller
{
    private $dadosPagina;
    private $galeria;
    private $imgGaleria;

    public function __construct() {
        $this->galeria = new Galeria();
        $this->imgGaleria = new ImagemGaleria();
    }

    public function index() {
        $this->dadosPagina['tituloPagina'] = 'Galerias';
        $this->dadosPagina['galerias'] = $this->galeria->getGaleriasPaginadas(10);
        return view('cms.paginas.galeria.index', $this->dadosPagina);
    }

    public function create() {
        return view('cms.paginas.galeria.create');
    }

    public function store(Request $request) {
        $data = $request->only([
            'titulo',
            'descricao',
        ]);

        $rules = [
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string', 'max:255'],
        ];

        $validator = Validator::make($data, $rules);

        if($validator->fails()) {
            return redirect()->route('admin.galerias.create')
            ->withErrors($validator)
            ->withInput();
        }

        $this->galeria = Galeria::firstOrNew(['titulo' => $data['titulo']]);
        try {
            if (!$this->galeria->exists) {
                $this->galeria->titulo = $data['titulo'];
                $this->galeria->descricao = $data['descricao'];
                $this->galeria->save();
                return redirect()->route('admin.galerias.index')->with('success', 'Galeria criada com sucesso!');

            } else {
                return redirect()->route('admin.galerias.create')->with('error', 'Uma Galeria com esse nome já existe.');
            }

        } catch (\Exception $e) {
            return redirect()->route('admin.galerias.create')->with('errors', 'Ocorreu um erro ao criar a galeria. Por favor, tente novamente.');
        }
    }

    public function edit(Request $request) {
        $idGaleria = $request->id;
        $galeria = Galeria::findOrFail($idGaleria);

        $this->dadosPagina = [
            'galeria' => $galeria,
            'imagens' => $this->imgGaleria->getImagensByGaleriaId($idGaleria),
        ];

        return view('cms.paginas.galeria.edit', $this->dadosPagina);
    }

    public function update(Request $request, $id) {
        $galeria = Galeria::findOrFail($id);

        $data = $request->only([
            'titulo',
            'descricao',
        ]);

        $rules = [
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string', 'max:255'],
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.galerias.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $galeria->titulo = $data['titulo'];
            $galeria->descricao = $data['descricao'];

            $galeria->update();

            return redirect()->route('admin.galerias.edit', ['id' => $id])->with('success', 'Galeria atualizada com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('admin.galeria.edit', ['id' => $id])
                ->with('error', 'Ocorreu um erro ao atualizar a galeria. Por favor, tente novamente.');
        }
    }

    public function delete(Request $request) {
        $idGaleria = $request->id;
        $this->galeria = Galeria::find($idGaleria);
        if (!$this->galeria) {
            return redirect()->route('admin.galerias.index')->with('error', 'Galeria não encontrado.');
        }
        try {
            $this->galeria->delete();
            return redirect()->route('admin.galerias.index')->with('success', 'Galeria excluída com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('admin.galerias.index')->with('error', 'Erro ao tentar excluir a galeria.');
        }
    }

    public function add(Request $request) {

        $idGaleria = $request->id;

        $data = $request->only([
            'img_titulo',
            'src',
        ]);

        $rules = [
            'img_titulo' => ['required', 'string', 'max:255'],
            'src' => ['required','file', 'mimes:jpg,png,webp'],
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.galerias.edit', ['id' => $idGaleria])
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $this->imgGaleria->galeria_id = $idGaleria;
            $this->imgGaleria->img_titulo = $data['img_titulo'];
            if ($request->hasFile('src') && $request->file('src')->isValid()) {
                $path = $request->file('src')->store('public/images');
                $url = asset(Storage::url($path));
                $this->imgGaleria->src = $url;
            }
            $this->imgGaleria->save();
            return redirect()->route('admin.galerias.edit', ['id' => $idGaleria])->with('success', 'Imagem adicionada na Galeria!');
        } catch (\Exception $e) {
            return redirect()->route('admin.galerias.edit', ['id' => $idGaleria])
                ->with('error', 'Ocorreu um erro ao atualizar a galeria. Por favor, tente novamente.');
        }
    }

    public function remove(Request $request) {
        $idImagem = $request->id_imagem;
        $idGaleria = $request->id;
        $imagem = ImagemGaleria::find($idImagem);
        if (!$imagem) {
            return redirect()->route('admin.galerias.edit', ['id' => $idGaleria])->with('error', 'Imagem não encontrada.');
        }
        try {
            $imagem->delete();
            return redirect()->route('admin.galerias.edit', ['id' => $idGaleria])->with('success', 'Imagem excluída com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('admin.galerias.edit', ['id' => $idGaleria])->with('error', 'Erro ao tentar excluir a imagem.');
        }
    }

}
