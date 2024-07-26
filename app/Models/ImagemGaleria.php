<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagemGaleria extends Model
{
    protected $table = 'galeria_imagem';

    public function getImagensByGaleriaId($id) {
        $imagens = ImagemGaleria::where('galeria_id', $id)->get();
        return $imagens;
    }
}
