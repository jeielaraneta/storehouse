<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('gic')->nullable();
            $table->string('group_name', 75)->nullable();
            $table->string('agc', 10)->nullable(); //anonymous giver code
            $table->enum('service_type', ['ews', 'mmws', 'vws', 'ss', 'pm', 'na']);
            $table->enum('record_type', ['dd', 'ob']);
            $table->date('given_at');
            $table->integer('status'); // 0:unverified 1:verified 2:removed 3:edited
            $table->integer('tithe_amount')->nullable();
            $table->integer('love_amount')->nullable();
            $table->integer('faith_amount')->nullable();
            $table->integer('total_amount')->nullable();
            $table->timestamps();
        });

        Schema::table('records', function (Blueprint $table) {
            $table->unsignedBigInteger('member_id')->nullable();
            $table->unsignedBigInteger('created_by');

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
