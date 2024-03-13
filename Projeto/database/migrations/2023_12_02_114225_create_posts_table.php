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
        Schema::connection('posts')->create('posts', function (Blueprint $table) {
            $table->id('id_post');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_language');
            $table->unsignedBigInteger('id_topic')->nullable();;
            $table->string('titulo');
            $table->text('conteudo');
            $table->timestamps();

            $table->foreign('id_user')
            ->references('id_user') 
            ->on('users.users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_language')
                ->references('id_language')
                ->on('language')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_topic')
                ->references('id_topic')
                ->on('topic')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
