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
        Schema::create('employee_tbl', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('login_id');
            $table->string('information_id');
            $table->string('educ');
            $table->string('position');
            $table->string('department');
            $table->string('employment_status');
            $table->string('resume');
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
