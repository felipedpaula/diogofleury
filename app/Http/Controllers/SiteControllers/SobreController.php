<?php

namespace App\Http\Controllers\SiteControllers;
use App\Http\Controllers\Controller;
use App\Models\Sobre;
use Illuminate\Http\Request;

class SobreController extends Controller
{
    private $dadosPagina;
    private $sobre;

    public function __construct() {
        $this->sobre = new Sobre();
    }

    public function index()
    {
        $this->dadosPagina['sobre'] = $this->sobre->getDadosSobre();
        return view('site.paginas.sobre.index', $this->dadosPagina);
    }
}
