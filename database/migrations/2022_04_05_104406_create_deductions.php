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
        Schema::create('deductions', function (Blueprint $table) {
            $table->id('deduction_id');
            $table->bigInteger('payrollManager_id');
            $table->bigInteger('employee_id');
            $table->string('deduction_name');
            $table->date('deduction_start_date');
            $table->date('deduction_end_date');
            $table->decimal('deduction_amount',9,2);
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
        Schema::dropIfExists('deductions');
    }
};
