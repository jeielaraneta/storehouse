<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialOfferingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_offerings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('designation', 75);
            $table->string('designated_for', 75)->nullable();
            $table->integer('designated_amount');
            $table->timestamps();
        });

        Schema::table('special_offerings', function (Blueprint $table) {
            $table->unsignedBigInteger('record_id');
    
            $table->foreign('record_id')->references('id')->on('records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_offering');
    }
}
