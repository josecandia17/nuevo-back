<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('podructos', function (Blueprint $table) {
            $table->id(); //pk, ai, BigInt Unsigned 
            $table-> string("nombre", 200);
            $table->decimal("precio", 10, 2)->default(0);
            $table->integer("cantidad")->default(0);
            $table->text("descripcion")->nullValue();
            $table->boolean("estado")->default(true);
            $table->string("imagen")->nullable();
            //n:1
            $table->bigInteger("categoria_id")->unsigned();
            $table->foreign("categoria_id")->references("id")->on("categorias");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podructos');
    }
};
