<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $fillable = [
        'tipo',
        'titulo',
        'slug',
        'resumo',
        'conteudo',
        'img_src',
        'video_src',
        'galeria_id',
        'status',
    ];

    /**
     * Função para buscar todos os projetoscom paginação, ordenando por ordem de criação.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getProjetosPaginados(int $perPage = 5) {
        return Projeto::orderBy('created_at', 'desc')
        ->where(function($query){
            if(request()->filled('search')){
               $query->Where('titulo', 'LIKE','%'. request()->get('search') .'%');
            }
        })
        ->paginate($perPage);
    }

    public function getProjetosPhotography() {
        $projetos = Projeto::orderBy('created_at', 'desc')->where('tipo', 1)->get();
        return $projetos;
    }

    public function getProjetosFilm() {
        $projetos = Projeto::orderBy('created_at', 'desc')->where('tipo', 2)->get();
        return $projetos;
    }
}
