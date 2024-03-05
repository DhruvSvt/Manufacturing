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
        Schema::table('employee_visits', function (Blueprint $table) {
            $table->unsignedBigInteger("tour_id")->nullable();
            $table->foreign('tour_id')->references('id')
                ->on('tour_programes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_visits', function (Blueprint $table) {
            //
        });
    }
};
