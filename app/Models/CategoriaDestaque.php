<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaDestaque extends Model
{
    use HasFactory;

    protected $table = 'categorias_destaques';

    /**
     * Função para buscar todos as Categorias de Destaques com paginação, ordenando por criação.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCategoriasDestaquePaginadas(int $perPage = 15)
    {
        return CategoriaDestaque::where('status', 1)->paginate($perPage);
    }

    public function destaques(){
        return $this->hasMany(Destaque::class , 'categoria_id');
    }

}
