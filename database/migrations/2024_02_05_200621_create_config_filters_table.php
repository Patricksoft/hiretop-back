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
        Schema::create('config_filters', function (Blueprint $table) {
            $table->id();
            $table->json("regions")->nullable();
            $table->json("sectors")->nullable();
            $table->integer("year_exp")->nullable();
            $table->json("type_contracts")->nullable();
            $table->json("type_location")->nullable();
            $table->integer("remuneration")->nullable();
            $table->json("languages")->nullable();
            $table->integer("user_id")->nullable();
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
        Schema::dropIfExists('config_filters');
    }
};
