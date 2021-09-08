<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDropDownOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drop_down_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('drop_down_id')->nullable();
            $table->foreign('drop_down_id')->references('id')->on('drop_downs')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('sec_dropdown_id')->nullable();
            $table->string('option_name');
            $table->string('status')->comment('1 for active 0 for inactive');
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
        Schema::dropIfExists('drop_down_options');
    }
}
