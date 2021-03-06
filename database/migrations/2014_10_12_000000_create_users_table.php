<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 70);
            $table->string('first_name', 70);
            $table->string('middle_name', 70);
            $table->string('last_name', 70);
            $table->string('contact_number', 20)->nullable();
            $table->string('email')->unique();
            $table->boolean('status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('password_reset_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
