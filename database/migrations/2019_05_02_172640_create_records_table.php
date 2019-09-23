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
            $table->enum('giver_type', ['identified', 'anonymous', 'group', 'bank_depositor']);
            $table->string('group_name', 75)->nullable();
            $table->string('agc', 75)->nullable(); //anonymous giver code
            $table->enum('service_type', ['ews', 'mmws', 'vws', 'ss', 'pm', 'na']);
            $table->enum('record_type', ['nob', 'ob']);
            $table->enum('offer_method', ['cash', 'check', 'direct_deposit']);
            $table->string('deposit_reference', 75)->nullable();
            $table->string('check_reference', 75)->nullable();
            $table->string('bank_name', 75)->nullable();
            $table->string('currency', 75);
            $table->boolean('convert_to_peso')->default(0);
            $table->date('given_at');
            $table->enum('status', ['Verified', 'For Correction', 'Corrected', 'For Archive', 'Archived', 'Unverified']);
            $table->integer('tithe_amount')->default(0);
            $table->integer('love_amount')->default(0);
            $table->integer('faith_amount')->default(0);
            $table->integer('total_amount')->default(0);
            $table->string('created_by', 75);
            $table->string('updated_by', 75)->nullable();
            $table->timestamps();
        });

        Schema::table('records', function (Blueprint $table) {
            $table->unsignedBigInteger('member_id')->nullable();

            $table->foreign('member_id')->references('id')->on('members');
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
