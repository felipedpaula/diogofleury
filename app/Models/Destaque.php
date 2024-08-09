<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destaque extends Model
{
    use HasFactory;

    protected $table = 'destaques';

    protected $fillable = [
        'categoria_id' ,
        'titulo',
        'subtitulo' ,
        'conteudo',
        'url_link',
        'txt_link',
        'img_src',
        'video_src',
        'date_start',
        'date_end',
        'order' ,
        'status'
    ];

    public function getDestaquesByCategoriaId($id, int $perPage = 15) {
        $destaques = Destaque::where('categoria_id', $id)->paginate($perPage);
        return $destaques;
    }

    public function categoria(){
        return $this->belongsTo(CategoriaDestaque::class , 'categoria_id');
    }

    public function getDestaques($bloco_slug, $limit = null) {

        $destaques = Destaque::join('categorias_destaques as categ', 'destaques.categoria_id', '=', 'categ.id')
                    ->select(
                        'destaques.titulo',
                        'destaques.subtitulo',
                        'destaques.conteudo',
                        'destaques.url_link',
                        'destaques.txt_link',
                        'destaques.img_src',
                        'destaques.video_src',
                        'destaques.date_start',
                        'destaques.date_end',
                        'destaques.order',
                        'destaques.status',
                        'categ.titulo as categ_titulo',
                        'categ.slug as categ_slug')
                    ->where('destaques.status', '1')
                    ->where('categ.slug', $bloco_slug)
                    ->orderBy('destaques.order', 'asc')
                    ->limit($limit)
                    ->get();

        return $destaques;
    }

}
