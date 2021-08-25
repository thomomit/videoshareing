<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConvertedToPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_post', function (Blueprint $table) {
            // 動画変換パスを追加
            $table->string('converted')->nullable();
            // サムネイルパスを追加
            $table->string('thumbnail')->nullable();
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
            // 動画変換パスを追加
            $table->dropColumn('converted')->nullable();
            // サムネイルパスを追加
            $table->string('thumbnail')->nullable();
        });
    }
}
