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
        Schema::create('pagibigs', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->string('ee_max_rate');
            $table->string('ee_min_rate');
            $table->string('er_rate');
            $table->string('maximum');
            $table->string('divider');
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
        Schema::dropIfExists('pagibigs');
    }
};
