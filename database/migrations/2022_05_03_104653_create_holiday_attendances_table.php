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
        Schema::create('holiday_attendances', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->bigInteger('holiday_id');
            $table->bigInteger('attendance_id');
            $table->bigInteger('payrollManager_id');
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
        Schema::dropIfExists('holiday_attendances');
    }
};
