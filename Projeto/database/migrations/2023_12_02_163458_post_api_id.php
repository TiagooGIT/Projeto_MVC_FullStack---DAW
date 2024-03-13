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
        Schema::connection('posts')->create('postsAPI_IDs', function (Blueprint $table) {
            $table->id('id_postsAPI_ID');
            $table->unsignedBigInteger('local_post_id');
            $table->string('api_post_id');
            $table->string('api_translated_post_id')->nullable();
            $table->timestamps();

            $table->foreign('local_post_id')
                ->references('id_post')
                ->on('posts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('posts')->dropIfExists('postsAPI_IDs');
    }
};
