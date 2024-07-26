<?php

namespace App\Http\Controllers\SiteControllers;
use App\Http\Controllers\Controller;
use App\Models\Projeto;
use App\Models\ImagemGaleria;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    private $dadosPagina;
    private $projeto;
    private $imagem;

    public function __construct() {
        $this->projeto = new Projeto();
        $this->imagem = new ImagemGaleria();
    }

    public function index()
    {
        $this->dadosPagina['projetos'] = $this->projeto->getProjetos();

        return view('site.paginas.portfolio.index', $this->dadosPagina);
    }

    public function single(Request $request)
    {
        $projeto = Projeto::where('slug', $request->slug)->firstOrFail();
        $imagens = $this->imagem->getImagensByGaleriaId($projeto->galeria_id);
        $this->dadosPagina['projeto'] = $projeto;
        $this->dadosPagina['imagens'] = $imagens;
        return view('site.paginas.portfolio.single', $this->dadosPagina);
    }
}
