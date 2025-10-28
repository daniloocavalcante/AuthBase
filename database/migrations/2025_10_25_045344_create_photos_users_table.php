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
        Schema::create('photos_users', function (Blueprint $table) {
            $table->id(); // id BIGINT PRIMARY KEY AUTO_INCREMENT
            $table->string('filename', 255); // filename VARCHAR(255) NOT NULL
            $table->string('mime_type', 100); // ext VARCHAR(10)
            $table->string('path', 512)->nullable(); // src VARCHAR(512)
            $table->unsignedBigInteger('size')->nullable(); // size INTEGER
            
            // A chave estrangeira para users(id) não pode ser adicionada aqui,
            // pois a tabela 'users' ainda não existe. Será adicionada em uma Migration de usuários.
            
            $table->boolean('visible')->default(true); // visible BOOLEAN DEFAULT TRUE

            // Se o 'uploader_user_id' puder ser NULL, a chave estrangeira será NULLABLE.
            $table->unsignedBigInteger('uploader_user_id'); // uploader_user_id BIGINT
            $table->foreign('uploader_user_id')->references('id')->on('users');

            $table->timestamps(); // updated_at TIMESTAMP, created_at TIMESTAMP NOT NULL           

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos_users');
    }
};