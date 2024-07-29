<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('usuario_tipos')->insert([
            'titulo' => 'Root',
        ]);

        DB::table('usuario_tipos')->insert([
            'titulo' => 'Administrador',
        ]);

        DB::table('usuario_tipos')->insert([
            'titulo' => 'Assistente de conteúdo',
        ]);

        DB::table('usuarios')->insert([
            'nome' => 'Felipe',
            'tipo_id' => 1,
            'email' => 'felipeppdev@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('usuarios')->insert([
            'nome' => 'Diogo',
            'tipo_id' => 1,
            'email' => 'diogopfa@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('conteudo_tipos')->insert([
            'titulo' => 'Artigos',
            'slug' => 'artigos'
        ]);

        DB::table('categorias_destaques')->insert([
            [
                'titulo' => 'Home Screen',
                'descricao' => '1 ou mais',
                'slug' => 'home-screen',
                'img_size' => '900x500',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('sobre')->insert([
            [
                'titulo' => 'Sobre mim',
                'conteudo' => 'Meu nome é Diogo Fleury e estou aqui para te ajudar.',
                'img_src' => null,
                'status' => 1,
            ],
        ]);
    }
}
