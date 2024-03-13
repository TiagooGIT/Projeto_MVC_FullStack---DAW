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
        Schema::connection('posts')->create('post_deleted', function (Blueprint $table) {
            $table->id('id_post_deleted');
            $table->unsignedBigInteger('id_user');
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('deleted_by');
            $table->text('reason');
            $table->timestamps();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users.users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('deleted_by')
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
        Schema::table('post_deleted', function (Blueprint $table) {
            //
        });
    }
};
