<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndorsementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endorsements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->foreign('candidate_id')->references('id')->on('candidate_informations')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('app_status');
            $table->string('remarks_endo');
            $table->string('client_endo');
            $table->tinyInteger('status');
            $table->string('type');
            $table->string('site');
            $table->string('domain_endo');
            $table->date('interview_data');
            $table->string('career_endo');
            $table->unsignedBigInteger('segment_id');
            $table->foreign('segment_id')->references('id')->on('segments')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('sub_segment_id')->nullable();
            $table->foreign('sub_segment_id')->references('id')->on('sub_segments')->onDelete('cascade')->onUpdate('cascade');
            $table->date('endi_date');
            $table->text('remarks_for_finance');
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
        Schema::dropIfExists('endorsements');
    }
}
