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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nombre_cliente');
            $table->string('email_cliente');
            $table->string('telefono_cliente');
            $table->string('estado')->default('nuevo');
            $table->string('metodo_entrega')->default('recoleccion_tienda');
            $table->decimal('total', 10, 2);
            $table->text('notas_cliente')->nullable();
            $table->text('notas_internas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
