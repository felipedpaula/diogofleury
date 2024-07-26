<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'tel',
        'nasc',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Função para buscar todos os usuários principais com paginação, ordenando por ordem alfabética.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUsuariosPaginados(int $perPage = 5) {
        return Usuario::whereNotIn('tipo_id', [4])
        ->orderBy('nome', 'desc')
        ->with('tipo')
        ->where(function($query){
            if(request()->filled('search')){
               $query->Where('nome', 'LIKE','%'. request()->get('search') .'%');
            }
        })
        ->paginate($perPage);
    }

    public function tipo(){
        return $this->belongsTo(UsuarioTipo::class , 'tipo_id');
    }
}
