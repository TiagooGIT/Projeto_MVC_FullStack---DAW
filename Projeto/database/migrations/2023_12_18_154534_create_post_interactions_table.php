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
        Schema::connection('posts')->create('post_interactions', function (Blueprint $table) {
            $table->id('id_post_interactions');
            $table->unsignedBigInteger('id_post');
            $table->string('action'); // 'view_more', 'translation', etc.
            $table->timestamps();

            $table->foreign('id_post')
                ->references('id_post')
                ->on('posts.posts')
                ->onDelete('cascade')
                ->onUpdate('cascade');




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_interactions');
    }
};
