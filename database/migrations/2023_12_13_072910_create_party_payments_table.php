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
        Schema::create('party_payments', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->bigInteger('supplier_id')->nullable()->default(0);
            $table->string('amt')->nullable();
            $table->string('mode')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('party_payments');
    }
};
