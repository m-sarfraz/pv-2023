<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGettraveselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gettravesels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('c_profile');
            $table->string('domain');
            $table->string('segment');
            $table->string('s_segment');

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
        Schema::dropIfExists('gettravesels');
    }
}
