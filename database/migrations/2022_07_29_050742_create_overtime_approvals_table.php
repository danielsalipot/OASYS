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
        Schema::create('overtime_approvals', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('attendance_id');
            $table->date('overtime_date');
            $table->longText('message');
            $table->date('approval_date')->nullable();
            $table->string('approver_id')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('overtime_approvals');
    }
};
