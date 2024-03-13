<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('posts')->create('topic', function (Blueprint $table) {
            $table->id('id_topic');
            $table->unsignedBigInteger('id_user');
            $table->string('title_topic');
            $table->text('description_topic');
            $table->timestamps();

            // Foreign key constraint with cascade delete
            $table->foreign('id_user')
                ->references('id_user')
                ->on('users.users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('posts')->dropIfExists('topic');
    }
}
