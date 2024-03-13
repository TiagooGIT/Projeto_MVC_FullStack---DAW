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
        Schema::connection('posts')->create('ud_votes', function (Blueprint $table) {
            $table->id('id_votes');
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id_user');
            $table->enum('vote', ['up', 'down']); // 'up' para voto positivo, 'down' para voto negativo
            $table->unique(['id_user', 'id_post']); // Garante que um user só pode votar uma vez em um post
            $table->timestamps();
            
            $table->foreign('id_post')
                ->references('id_post')
                ->on('posts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users.users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
