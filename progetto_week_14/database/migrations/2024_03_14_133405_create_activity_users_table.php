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
        Schema::create('activity_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('activity_id');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('activity_id')
                  ->references('id')
                  ->on('activities')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // $table->unique(['user_id', 'activity_id']);
            // mi blocca in fase di seeding, non riesco ne con cicli while 
            // per controllare se la coppia esiste già, ne con array di coppie
            // pre-impostate. Dovrei generarle manualmente, o in modo non-random
            // ma non mi va e perderebbe di realismo. 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_users');
    }
};
