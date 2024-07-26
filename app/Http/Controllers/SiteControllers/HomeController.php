<?php

namespace App\Http\Controllers\SiteControllers;
use App\Http\Controllers\Controller;
use App\Models\Destaque;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $dadosPagina;
    private $destaque;

    public function __construct() {
        $this->destaque = new Destaque();
    }

    public function index()
    {
        $this->dadosPagina['destaques_home'] = $this->destaque->getDestaques('home-screen', 5);

        return view('site.paginas.home.index', $this->dadosPagina);
    }
}
