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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string("label");
            $table->integer("country_id");
            $table->json("interval_salary");
            $table->string("type_location");
            $table->integer("sector_id");
            $table->json("year_exp");
            $table->string("type_work");
            $table->json("languages");
            $table->longText("detail");
            $table->boolean("status")->default(true);
            $table->integer("user_id");
            $table->integer("company_id");
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
        Schema::dropIfExists('offers');
    }
};
