<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imoveis', function (Blueprint $table) {
            $table->increments('id')->startingValue(20000);
            $table->string('endereco');
            $table->integer('valor');
            $table->text('descricao');
            $table->integer('area');
            $table->integer('quartos');
            $table->float('latitude');
            $table->float('longitude');
            $table->float('iptu');
            $table->integer('condominio');
            $table->boolean('mobilia');
            $table->integer('vagas');
            $table->unsignedBigInteger('bairro_id');
            $table->foreign('bairro_id')->references('id')->on('bairros')->onDelete('restrict');
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('restrict');
            $table->unsignedBigInteger('finalidade_id');
            $table->foreign('finalidade_id')->references('id')->on('finalidades')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imoveis');
    }
};
