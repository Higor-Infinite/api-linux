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
    Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->text('descricao');
        $table->string('status')->index();
        $table->string('prioridade')->index();
        $table->foreignId('responsavel_id')
            ->constrained('users')
            ->restrictOnDelete();
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
