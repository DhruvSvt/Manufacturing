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
        Schema::create('employee_order_gifts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("visit_id");
            $table->unsignedBigInteger("employee_id");
            $table->unsignedBigInteger("gift_id");
            $table->integer("quantity");
            $table->timestamps();
            $table->foreign('visit_id')->references('id')
                ->on('employee_visits')->cascadeOnDelete();

            $table->foreign('employee_id')->references('id')
                ->on('employees')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_order_gifts');
    }
};
