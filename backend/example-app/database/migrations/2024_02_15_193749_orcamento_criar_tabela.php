<?php

use App\Models\Cliente;
use App\Models\Vendedores;
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
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->float('valor',8,2);
            $table->foreignIdFor(Cliente::class);
            $table->string('nameCliente');
            $table->foreignIdFor(Vendedores::class);
            $table->string('nameVendedor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
