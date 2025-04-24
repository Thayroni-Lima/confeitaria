<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('confeitaria_id')->constrained()->onDelete('cascade');
            $table->string('nome');
            $table->decimal('valor', 8, 2);
            $table->text('descricao')->nullable();
            $table->string('imagem')->nullable(); // path da imagem por enquanto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
