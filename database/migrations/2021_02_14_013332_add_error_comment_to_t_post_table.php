<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddErrorCommentToTPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_post', function (Blueprint $table) {
            $table->string('error_comment')->nullable(); // エラー時のコメントカラム追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_post', function (Blueprint $table) {
            $table->dropColumn('error_comment')->nullable(); // エラー時のコメントからむ
        });
    }
}
