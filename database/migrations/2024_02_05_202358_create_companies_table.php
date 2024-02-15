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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->date("creation_date");
            $table->integer("sector_id");
            $table->string("doc_official");
            $table->string("contact");
            $table->string("email");
            $table->integer("country_id")->nullable();
            $table->string("linkedin")->nullable();
            $table->string("web_site")->nullable();
            $table->string("fb_page")->nullable();
            $table->boolean("validated_at")->nullable();
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
        Schema::dropIfExists('companies');
    }
};
