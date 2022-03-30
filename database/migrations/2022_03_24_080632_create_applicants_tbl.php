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
        Schema::create('applicants_tbl', function (Blueprint $table) {
            $table->id('applicant_id');
            $table->string('login_id');
            $table->string('information_id');
            $table->string('educ');
            $table->string('Applyingfor');
            $table->string('resume');
            $table->timestamp('applied_on')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants_tbl');
    }
};
