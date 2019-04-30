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
            $table->integer('contact_number')->nullable();
            $table->string('email' 30)->nullable();
            $table->enum('marital_status', ['married', 'widowed', 'separate', 'divorced', 'single'])->nullable();
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
