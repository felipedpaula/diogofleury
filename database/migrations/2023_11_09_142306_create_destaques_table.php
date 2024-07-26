<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('destaques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categorias_destaques');
            $table->string('titulo');
            $table->string('subtitulo')->nullable();
            $table->text('conteudo')->nullable();
            $table->string('url_link')->nullable();
            $table->string('txt_link')->nullable();
            $table->string('img_src')->nullable();
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_end')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('destaques');
    }
};
