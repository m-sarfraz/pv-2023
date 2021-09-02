<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('gl23_tech')->nullable();
            $table->unsignedBigInteger('gl24_tech')->nullable();
            $table->unsignedBigInteger('gl25_tech')->nullable();
            $table->unsignedBigInteger('gl26_tech')->nullable();
            $table->unsignedBigInteger('gl27_tech')->nullable();
            $table->unsignedBigInteger('gl28_tech')->nullable();
            $table->unsignedBigInteger('gl29_tech')->nullable();
            $table->unsignedBigInteger('gl30_tech')->nullable();
            $table->unsignedBigInteger('gl22_bo')->comment('BUSINESS OPS')->nullable();
            $table->unsignedBigInteger('gl23_bo')->comment('BUSINESS OPS')->nullable();
            $table->unsignedBigInteger('gl24_bo_usrn')->comment('BUSINESS OPS')->nullable();
            $table->unsignedBigInteger('gl_24_bo')->nullable();
            $table->unsignedBigInteger('gl_25_bo')->nullable();
            $table->unsignedBigInteger('gl_26_bo')->nullable();
            $table->unsignedBigInteger('gl_27_bo')->nullable();
            $table->unsignedBigInteger('gl_28_bo')->nullable();
            $table->unsignedBigInteger('gl_29_bo')->nullable();
            $table->unsignedBigInteger('gl_30_bo')->nullable();
            $table->unsignedBigInteger('gl22_ss')->comment(' SHARED SERVICES')->nullable();
            $table->unsignedBigInteger('gl23_ss')->comment(' SHARED SERVICES')->nullable();
            $table->unsignedBigInteger('gl24_ss')->comment(' SHARED SERVICES')->nullable();
            $table->unsignedBigInteger('gl25_ss')->nullable();
            $table->unsignedBigInteger('gl26_ss')->nullable();
            $table->unsignedBigInteger('gl27_ss')->nullable();
            $table->unsignedBigInteger('gl28_ss')->nullable();
            $table->unsignedBigInteger('gl29_ss')->nullable();
            $table->unsignedBigInteger('gl30_ss')->nullable();
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
        Schema::dropIfExists('gl');
    }
}
