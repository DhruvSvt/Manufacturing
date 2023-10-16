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
        Schema::create('gift_issues', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('gift_id')->nullable()->default(0);
            $table->bigInteger('supplier_id')->nullable()->default(0);
            $table->bigInteger('headquarter_id')->nullable()->default(0);
            $table->bigInteger('qty')->nullable();
            $table->bigInteger('amount')->nullable();
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
        Schema::dropIfExists('gift_issue');
    }
};
