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
        Schema::table('tour_programes', function (Blueprint $table) {
            $table->timestamp("starting_date_time")->nullable();
            $table->timestamp("ended_date_time")->nullable();
            $table->string("starting_lat")->nullable();
            $table->string("ended_lat")->nullable();
            $table->string("starting_long")->nullable();
            $table->string("ended_long")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_programes', function (Blueprint $table) {
            //
        });
    }
};
