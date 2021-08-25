<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_post', function (Blueprint $table) {
            $table->id();
            $table->timestamp('create_at')->nullable();
            $table->timestamp('edit_at')->nullable();
            $table->tinyInteger('delete_flg')->nullable();
            $table->string('team', 255)->nullable();
            $table->text('title')->nullable();
            $table->text('video_path')->nullable();
            $table->tinyInteger('view_mode')->nullable();
            $table->integer('view_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_post');
    }
}
