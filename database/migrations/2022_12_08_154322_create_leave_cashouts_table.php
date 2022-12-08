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
        Schema::create('leave_cashouts', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->integer('leave_days');
            $table->integer('approval_status')->nullable();
            $table->string('approver_id')->nullable();
            $table->date('approval_date')->nullable();
            $table->decimal('total_cashout',9,2);
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
        Schema::dropIfExists('leave_cashouts');
    }
};
