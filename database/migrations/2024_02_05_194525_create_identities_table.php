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
        Schema::create('identities', function (Blueprint $table) {
            $table->id();
            $table->string("firstname");
            $table->string("lastname");
            $table->string("email");
            $table->string("phone");
            $table->string("address")->nullable();
            $table->date("birthday")->nullable();
            $table->enum("marital_status",["single","married","widowed", "divorced"])->default("single");
            $table->integer("country_id")->nullable();
            $table->string("linkedin")->nullable();
            $table->string("cv")->nullable();
            $table->integer("user_id");
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
        Schema::dropIfExists('identities');
    }
};
