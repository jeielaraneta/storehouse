<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 8)->nullable()->unique();
            $table->string('first_name', 30);
            $table->string('middle_name', 30);
            $table->string('last_name', 30);
            $table->date('birthday');
            $table->integer('age');
            $table->bigInteger('contact_number')->nullable();
            $table->string('email', 30)->unique()->nullable();
            $table->enum('marital_status', ['married', 'widowed', 'separate', 'divorced', 'single', 'undisclosed']);
            $table->enum('membership_status', ['active', 'regular attendee', 'visitor', 'inactive']);
            $table->boolean('member_account_status')->default(1);
            $table->string('address_line_1', 100)->nullable();
            $table->string('barangay', 50)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('province', 30)->nullable();
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
        Schema::dropIfExists('members');
    }
}
