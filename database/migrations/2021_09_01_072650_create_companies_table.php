<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('candidate_ownership')->nullable();
            $table->string('a_entry_level')->nullable();
            $table->string('executive_level')->nullable();
            $table->unsignedBigInteger('e_rates')->comment('Entry level rates')->nullable();
            $table->unsignedBigInteger('e_c_s_rates')->comment('entry/complex/specialized level rates')->nullable();
            $table->string('c_v_r_programs')->comment('Agent/complex-Voice Relay Programs/TSR/ Collections')->nullable();
            $table->text('c_hires')->comment('Project Base and Contractual hires')->nullable();
            $table->string('night_shift')->nullable();
            $table->string('gateway_hire')->comment('Agent/Gateway hire/SET')->nullable();
            $table->string('google_sr')->comment('Google NA Sales Representative')->nullable();
            $table->string('csr_tsr')->comment('Sales CSR & TSR (Air BnB & Google)')->nullable();
            $table->string('in_luzon')->comment('International Account luzon')->nullable();
            $table->string('in_visayas')->comment('International Account Visayas')->nullable();
            $table->unsignedBigInteger('local_acccount')->nullable(); 
            $table->unsignedBigInteger('aa_intl')->comment('Achieve Academy Intl')->nullable();
            $table->unsignedBigInteger('aa_local')->comment('Achieve Academy Local')->nullable();
            $table->unsignedBigInteger('trainee_ncr')->comment('trainee NCR')->nullable();
            $table->unsignedBigInteger('trainee_vm')->comment('trainee Visayas and Mindanao')->nullable();
            $table->string('pfsc')->comment('Premium Financial Services Account')->nullable();
            $table->unsignedBigInteger('cl13_v')->nullable();
            $table->unsignedBigInteger('cl13_nv')->nullable();
            $table->unsignedBigInteger('cl12_v')->nullable();
            $table->unsignedBigInteger('cl12_nv')->nullable();
            $table->unsignedBigInteger('cl11')->nullable();
            $table->unsignedBigInteger('cl10_sa')->comment('cl 10 senior analyst')->nullable();
            $table->unsignedBigInteger('cl10_usrn')->nullable();
            $table->unsignedBigInteger('cl9')->nullable();
            $table->unsignedBigInteger('cl8')->nullable();
            $table->unsignedBigInteger('cl7')->nullable();
            $table->unsignedBigInteger('cl6')->nullable();
            $table->unsignedBigInteger('cl5')->nullable();
            $table->string('executive')->nullable();
            $table->string('md')->nullable();
            $table->string('director')->nullable();
            $table->string('vp')->nullable();
            $table->string('avp')->nullable();
            $table->string('sm')->nullable();
            $table->string('m')->nullable();
            $table->string('am')->comment('Asst. Manager/Assoc Manager')->nullable();
            $table->string('team_lead')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('non_supervisory')->nullable();
            $table->string('multilingual')->nullable();
            $table->string('bilingual')->nullable();
            $table->unsignedBigInteger('usrn_active_license')->nullable();
            $table->unsignedBigInteger('usrn_inactive_license')->nullable();
            $table->string('nclex')->nullable();
            $table->string('na_entry_level')->nullable();
            $table->string('specialized_account')->nullable();
            $table->string('associate')->nullable();
            $table->string('advisor')->nullable();
            $table->string('senior_level')->nullable();
            $table->string('mid_level')->nullable();
            $table->string('junior_level')->nullable();
            $table->string('assoc_analyst')->nullable();
            $table->string('sen_analyst')->nullable();
            $table->string('analyst')->nullable();
            $table->string('b6')->nullable();
            $table->string('b7')->nullable();
            $table->string('b8')->nullable();
            $table->string('b9')->nullable();
            $table->string('b10')->nullable();
            $table->string('sme_level')->nullable();
            $table->string('advisor_2')->nullable();
            $table->string('advisor_1')->nullable();
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
}
