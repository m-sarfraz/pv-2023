<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->foreign('candidate_id')->references('id')->on('candidate_informations')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('candidate_profile')->nullable();
            $table->string('position_applied')->nullable();
            $table->date('date_invited')->nullable();
            $table->tinyInteger('manner_of_invite');
            $table->string('curr_salary')->comment('current')->nullable();
            $table->string('exp_salary')->comment('expected')->nullable();
            $table->string('off_salary')->comment('offer')->nullable();
            $table->string('curr_allowance')->nullable();
            $table->string('off_allowance')->nullable();
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
        Schema::dropIfExists('candidate_positions');
    }
}
