<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $fillable = ['titulo', 'descricao'];

    /**
     * Função para buscar todas as galerias com paginação, ordenando por ordem de criação.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getGaleriasPaginadas(int $perPage = 5) {
        return Galeria::orderBy('created_at', 'desc')
        ->where(function($query){
            if(request()->filled('search')){
               $query->Where('titulo', 'LIKE','%'. request()->get('search') .'%');
            }
        })
        ->paginate($perPage);
    }

    public function getGalerias() {
        $galerias = Galeria::select('id', 'titulo')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return $galerias;
    }
}
