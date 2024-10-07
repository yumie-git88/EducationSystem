<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curricurum_progress', function (Blueprint $table) { //スペル注意
            $table->bigIncrements('id');
            $table->foreignId('curriculumus_id')->constrained('curriculums'); //スペル注意
            $table->foreignId('users_id')->constrained('users');
            $table->boolean('clear_flg'); // クリアフラグ(クリア：1,未クリア:0)
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
        Schema::dropIfExists('curricurum_progress');
    }
};
