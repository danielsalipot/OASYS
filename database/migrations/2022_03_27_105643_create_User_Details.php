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
        Schema::create('User_Details', function (Blueprint $table) {
            $table->id('information_id');
            $table->string('login_id');
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('sex');
            $table->string('age');
            $table->string('bday');
            $table->string('cnum');
            $table->string('email');
            $table->string('picture');
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
        Schema::dropIfExists('information_tbl');
    }
};
