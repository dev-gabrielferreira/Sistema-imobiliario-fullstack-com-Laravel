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
        Schema::create('finalidades', function (Blueprint $table) {
            $table->increments('id')->startingValue(300);
            $table->string('nome')->unique();
            $table->timestamps();
        });

        if(Config::get('database.default') == 'mysql'){
            DB::statement('ALTER TABLE finalidades AUTO_INCREMENT = 20000;');
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('finalidades');
    }
};
