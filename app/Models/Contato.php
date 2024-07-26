<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $table = 'contato_mensagens';

    protected $fillable = [
        'nome',
        'email',
        'tel',
        'mensagem',
    ];

    /**
     * Função para buscar todas as mensagens com paginação.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getContatosPaginados(int $perPage = 5) {
        return Contato::orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getNovosContatos() {
        return Contato::where('status', false)->get();
    }
}
