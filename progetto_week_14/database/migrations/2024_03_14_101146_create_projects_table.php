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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->date('start_date')->default(now());
            $table->date('end_date')->nullable();
            $table->string('client_name')->default('personal'); 
            // si potrebbe creare una tabella clients e associarla tramite id, 
            // ma diventerebbe piu complesso per gli scopi dell'esercizio
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->timestamps();

            $table->foreign('owner_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')  
                  //se cancello l'owner del progetto, giustamente cancello anche il suo progetto
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
