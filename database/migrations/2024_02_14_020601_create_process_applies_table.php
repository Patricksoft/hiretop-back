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
        Schema::create('process_applies', function (Blueprint $table) {
            $table->id();
            $table->integer("apply_id");
                $table->enum("step",["preselection","selection","competency_interview","reference_checking","job_offer","final_decision"])->default("preselection");

            $table->dateTime("preselection_at")->nullable();
            $table->longText("preselection_msg")->nullable();
            $table->json("selection_interview_planning")->nullable();
            $table->dateTime("selection_interview_planning_selected")->nullable();
            $table->enum("selection_decision",["accepted","refused"])->nullable();

            $table->dateTime("selection_at")->nullable();
            $table->longText("selection_msg")->nullable();
            $table->json("competency_interview_planning")->nullable();
            $table->dateTime("competency_interview_planning_selected")->nullable();
            $table->enum("competency_interview_decision",["accepted","refused"])->nullable();


            $table->dateTime("competency_interview_at")->nullable();
            $table->longText("competency_interview_msg")->nullable();
            $table->enum("reference_checking_decision",["accepted","refused"])->nullable();

            $table->dateTime("reference_checking_at")->nullable();
            $table->longText("reference_checking_msg")->nullable();
            $table->enum("job_offer_decision",["accepted","refused"])->nullable();


            $table->dateTime("job_offer_at")->nullable();
            $table->longText("job_offer_msg")->nullable();

            $table->dateTime("final_decision_at")->nullable();
            $table->longText("final_decision_msg")->nullable();
            $table->enum("final_decision_decision",["accepted","refused"])->nullable();

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
        Schema::dropIfExists('process_applies');
    }
};
