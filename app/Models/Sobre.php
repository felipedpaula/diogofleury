<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sobre extends Model
{
    protected $table = 'sobre';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'conteudo',
        'status',
        'img_src',
    ];

    public function getDadosSobre() {
        $dados = Sobre::where('id', 1)->where('status', true)->first();
        return $dados;
    }
}
