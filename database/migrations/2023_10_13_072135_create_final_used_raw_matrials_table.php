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
        Schema::create('final_used_raw_matrials', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('production_id')->nullable();
            $table->bigInteger('raw_material_id')->nullable();
            $table->string('qty')->nullable();
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
        Schema::dropIfExists('final_used_raw_matrials');
    }
};
