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
        Schema::create('tour_programes', function (Blueprint $table) {
            $table->id();
            $table->date("tour_date");
            $table->unsignedBigInteger("employee_id");
            $table->string("start_location");
            $table->string("end_location");
            $table->foreign('employee_id')->references('id')
            ->on('employees')->cascadeOnDelete();
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
        Schema::dropIfExists('tour_programes');
    }
};
