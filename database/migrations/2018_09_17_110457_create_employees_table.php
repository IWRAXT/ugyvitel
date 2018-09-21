<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{

    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->date('born');
            $table->string('image')->default('default.jpg');
            $table->string('address');
            $table->string('phone_number');
            $table->integer('month_salary');
            $table->boolean('definite_employment');
            $table->date('recruitment_date');
            $table->string('job');
            $table->string('comment');

            $table->timestamps();

            $table->integer('principal_id')->nullable();
            $table->integer('user_id')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
