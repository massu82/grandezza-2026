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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->text('descripcion_corta')->nullable();
            $table->longText('descripcion_larga')->nullable();
            $table->decimal('precio', 10, 2);
            $table->decimal('precio_promocion', 10, 2)->nullable();
            $table->integer('porcentaje_descuento')->nullable();
            $table->foreignId('categoria_id')->constrained('categories')->cascadeOnDelete();
            $table->string('tipo');
            $table->string('pais')->nullable();
            $table->string('region')->nullable();
            $table->string('uva')->nullable();
            $table->integer('anada')->nullable();
            $table->integer('stock');
            $table->string('sku')->unique();
            $table->tinyInteger('estado')->default(1);
            $table->json('tags')->nullable();
            $table->string('imagen_principal')->nullable();
            $table->json('galeria')->nullable();
            $table->boolean('destacado')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
