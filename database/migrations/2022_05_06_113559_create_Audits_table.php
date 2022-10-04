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
        Schema::create('audits', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->bigInteger('payroll_manager_id');
            $table->string('activity_type');
            $table->string('type');
            $table->string('employee')->nullable();
            $table->string('activity');
            $table->string('amount');
            $table->bigInteger('tid')->nullable();
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
        Schema::dropIfExists('Audits');
    }
};
