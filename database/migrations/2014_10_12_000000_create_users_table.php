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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); //UNSIGNED BIGINT
            $table->string('name', 255);
            $table->string('name_kana', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('profile_image', 255)->nullable();
            $table->foreignId('grade_id')->constrained();  // クラスID
            $table->timestamps();
            // $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
