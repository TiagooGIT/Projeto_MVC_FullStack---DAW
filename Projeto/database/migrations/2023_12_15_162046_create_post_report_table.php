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
        Schema::connection('posts')->create('post_report', function (Blueprint $table) {
            $table->id('id_post_report');
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id_user');
            $table->text('reason');
            $table->timestamps();
    
            $table->foreign('id_post')
                ->references('id_post')
                ->on('posts.posts')
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
        Schema::table('post_report', function (Blueprint $table) {
            //
        });
    }
};
