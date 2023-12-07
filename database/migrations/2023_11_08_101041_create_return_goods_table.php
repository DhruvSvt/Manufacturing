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
        Schema::create('return_goods', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id')->default(0)->nullable();
            $table->string('builty')->nullable();
            $table->string('transport')->nullable();
            $table->date('dispatch')->nullable();
            $table->date('date_of_receipt')->nullable();
            $table->string('receipt')->nullable();
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
        Schema::dropIfExists('return_goods');
    }
};
