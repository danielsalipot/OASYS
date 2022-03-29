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
        Schema::create('login_tbl', function (Blueprint $table) {
            $table->id('login_id');
            $table->string('username');
            $table->string('password');
            $table->string('user_type');
            $table->date('created_at')->default(DB::raw('CURRENT_DATE()'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_tbl');
    }
};
