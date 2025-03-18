<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            /////////laravel7以降の外部キーの書き方/////////
            $table->foreignId('lesson_id')->constrained(); // foreignIdでUNSIGNED BIGINTになる
            $table->foreignId('user_id')->constrained(); // constrainedは参照先テーブルをカラム名から自動で判断してreferences()->on() のチェーンを呼ぶ

            /////////laravel6までの外部キーの書き方/////////
            // $table->bigInteger('lesson_id')->unsigned();
            // $table->foreign('lesson_id')->references('id')->on('lessons');
            // $table->bigInteger('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
