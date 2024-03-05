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
        Schema::create('employee_order_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("visit_id");
            $table->unsignedBigInteger("employee_id");
            $table->unsignedBigInteger("product_id");
            $table->integer("quantity");
            $table->foreign('visit_id')->references('id')
            ->on('employee_visits')->cascadeOnDelete();
            $table->foreign('employee_id')->references('id')
            ->on('employees')->cascadeOnDelete();
            $table->foreign('product_id')->references('id')
            ->on('products')->cascadeOnDelete();
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
        Schema::dropIfExists('employee_order_products');
    }
};
