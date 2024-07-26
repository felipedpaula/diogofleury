<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Contato;

class ContatoComposer
{
    private $contatos;

    public function __construct() {
        $this->contatos = new Contato();
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $contatos = $this->contatos->getNovosContatos();
        $view->with('mensagens', $contatos);
    }
}
