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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("label");
            $table->string("type_work");
            $table->string("company");
            $table->string("region_id");
            $table->string("type_location");
            $table->date("begin");
            $table->date("end");
            $table->boolean("current_post")->default(false);
            $table->integer("sector_id");
            $table->longText("description");
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
        Schema::dropIfExists('experiences');
    }
};
