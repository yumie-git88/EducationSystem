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
        Schema::create('curricurum_progress', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('curriculumus_id', 10)->constrained();
            $table->foreignId('users_id', 10)->constrained();
            $table->boolean('clear_flg', 4)->default(false); // クリアフラグ(クリア：1,未クリア:0)
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
