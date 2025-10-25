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
        Schema::create('app_logs', function (Blueprint $table) {
            $table->id(); // id BIGINT PRIMARY KEY AUTO_INCREMENT
            
            // Chave estrangeira para users
            $table->unsignedBigInteger('user_id')->nullable(); // user_id BIGINT
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->timestamp('logged_at')->useCurrent(); // logged_at TIMESTAMP NOT NULL (Assumindo que você quer a hora atual)
            $table->string('level', 20); // level VARCHAR(20) NOT NULL
            $table->string('source', 100); // source VARCHAR(100) NOT NULL
            $table->text('message'); // message TEXT NOT NULL
            // Não há 'updated_at' ou 'created_at' aqui, pois a coluna 'logged_at' serve a este propósito
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_logs');
    }
};