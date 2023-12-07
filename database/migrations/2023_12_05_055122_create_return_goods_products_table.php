<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Testing\Constraints\SoftDeletedInDatabase;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_goods_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('return_good_id')->nullable()->default(0);
            $table->bigInteger('product_id')->nullable()->default(0);
            $table->string('qty')->nullable()->default(0);
            $table->string('rate')->nullable()->default(0);
            $table->string('batch_no')->nullable();
            $table->string('reason_of_return')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('return_goods_products');
    }
};
