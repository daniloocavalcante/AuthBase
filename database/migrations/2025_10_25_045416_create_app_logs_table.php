<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('app_logs', function (Blueprint $table) {
            $table->id();
            
            // Relacionamento com o usuário que fez a ação
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('set null');

            // O que foi feito: Created, Updated, Deleted, etc.
            $table->string('action', 50)->index();

            $table->string('ip_address', 45)->nullable(); // 45 caracteres para suportar IPv6
            
            // Descrição legível: "Editou o pet Totó"
            $table->string('description');

            // Polimorfismo simples: Qual Model e qual ID foi afetado
            $table->string('model_type')->nullable()->index();
            $table->unsignedBigInteger('model_id')->nullable()->index();

            $table->timestamp('created_at')->useCurrent()->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_logs');
    }
};