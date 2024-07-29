<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('tipo')->nullable(); // 1 - Fotos | 2 - Vídeos
            $table->string('titulo');
            $table->string('slug');
            $table->text('resumo')->nullable();
            $table->text('conteudo')->nullable();
            $table->string('img_src')->nullable();
            $table->string('video_src')->nullable();
            $table->unsignedBigInteger('galeria_id')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projetos');
    }
};
