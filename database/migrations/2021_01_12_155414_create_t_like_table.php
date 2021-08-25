<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_like', function (Blueprint $table) {
            $table->id();
            $table->timestamp('create_at')->nullable();
            $table->timestamp('edit_at')->nullable();
            $table->integer('iine')->default(0);
            $table->unsignedBigInteger('post_id');

            $table->foreign('post_id')->references('id')->on('t_post')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_like');
    }
}
