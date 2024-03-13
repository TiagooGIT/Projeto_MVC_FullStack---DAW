<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTranslatedTable extends Migration
{
    public function up()
    {
        Schema::connection('posts')->create('post_translated', function (Blueprint $table) {
            $table->id('id_post_translated');
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id_language')->nullable();
            $table->string('titulo');
            $table->text('conteudo');
            $table->tinyInteger('validacao')->default(0)->nullable();
            $table->text('comentario_validacao')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users.users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_post')
                ->references('id_post')
                ->on('posts.posts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_language')
                ->references('id_language')
                ->on('language')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::connection('posts')->dropIfExists('post_translated');
    }
}
