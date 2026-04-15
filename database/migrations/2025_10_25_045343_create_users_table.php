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
        Schema::create('users', function (Blueprint $table) {

            // Colunas de dados...
            $table->id(); // id BIGINT PRIMARY KEY AUTO_INCREMENT
            $table->string('name', 100); // name VARCHAR(100) NOT NULL
            $table->string('surname', 100)->nullable(); // surname VARCHAR(100)
            $table->date('birth')->nullable(); // birth DATE
            $table->string('gender', 30)->nullable(); // gender VARCHAR(15)
            $table->string('email', 255)->unique(); // email VARCHAR(255) UNIQUE NOT NULL
            $table->string('password');             
            $table->timestamp('last_login')->nullable();          

            
            // --- Colunas de Controle/Framework  --- 
            $table->timestamp('email_verified_at')->nullable(); // Para verificação de e-mail
            $table->rememberToken(); // Para o "Lembrar de mim" no login
            $table->timestamps(); // created_at e updated_at
        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
