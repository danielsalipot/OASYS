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
        Schema::create('resigneds', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->bigInteger('employee_id');
            $table->string('resignation_path');
            $table->integer('status')->nullable();
            $table->date('update_date')->nullable();
            $table->bigInteger('manager_id')->nullable();
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
        Schema::dropIfExists('resigneds');
    }
};
