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
        Schema::create('notif_tbl', function (Blueprint $table) {
            $table->id('notif_id');
            $table->string('sender_id');
            $table->string('receiver_id');
            $table->TEXT('title');
            $table->LONGTEXT('message');
            $table->timestamp('timestamp_sent')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notif_tbl');
    }
};
