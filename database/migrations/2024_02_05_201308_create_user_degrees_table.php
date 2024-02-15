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
        Schema::create('user_degrees', function (Blueprint $table) {
            $table->id();
            $table->integer("degree_id");
            $table->integer("user_id");
            $table->string("intitule");
            $table->string("school");
            $table->string("sector_id");
            $table->date("begin");
            $table->date("end");
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
        Schema::dropIfExists('user_degrees');
    }
};
