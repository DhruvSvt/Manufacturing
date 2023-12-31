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
        Schema::create('sample_issues', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->nullable()->default(0);
            $table->bigInteger('supplier_id')->nullable()->default(0);
            $table->bigInteger('headquarter_id')->nullable()->default(0);
            $table->bigInteger('qty')->nullable();
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
        Schema::dropIfExists('sample_issues');
    }
};
