<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->foreign('candidate_id')->references('id')->on('candidate_informations')->onDelete('cascade')->onUpdate('cascade');            $table->unsignedBigInteger('endorsement_id');
            $table->integer('remarks_recruiter');
            $table->date('onboarding_date');
            $table->unsignedBigInteger('invoice_number');
            $table->unsignedBigInteger('client_finance');
            $table->unsignedBigInteger('career_finance');
            $table->unsignedBigInteger('rate');
            $table->unsignedBigInteger('total_billable_amount');
            $table->unsignedBigInteger('srp')->comment('standard project revenue');
            $table->double('offered_salary');
            $table->double('placement_fee');
            $table->double('allowance_finance');
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
        Schema::dropIfExists('financess');
    }
}
