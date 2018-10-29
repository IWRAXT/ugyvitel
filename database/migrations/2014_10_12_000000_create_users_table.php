<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); //empployee névből lehetne
            $table->string('email')->unique(); //eployees email is lehetne
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->integer('permission_id')->nullable();
            $table->foreign('permission_id')
                  ->references('id')
                  ->on('permissions');

        });
    }


    public function down()
    {
        Schema::dropIfExists('users');

    }
}
