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
        Schema::create('employee_details', function (Blueprint $table) {
            $table->softDeletes();
            $table->id('employee_id');
            $table->bigInteger('login_id');
            $table->bigInteger('information_id');
            $table->string('educ');


            $table->string('position');
            $table->string('department');
            $table->decimal('rate',9,2);
            $table->string('employment_status');
            $table->string('resume');
            $table->date('start_date');
            $table->integer('leave_days');


            $table->json('schedule_days');
            $table->string('schedule_Timein');
            $table->string('schedule_Timeout');

            $table->integer('sss_included');
            $table->integer('philhealth_included');
            $table->integer('pagibig_included');

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
        Schema::dropIfExists('employee_tbl');
    }
};
