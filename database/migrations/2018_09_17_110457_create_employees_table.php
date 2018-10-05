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
            $table->date('born');//birth
            $table->string('image')->default('default.jpg');
            $table->string('email')->nullable()->unique();
            $table->string('address');
            $table->string('phone_number')->nullable();
            $table->integer('month_salary');
            $table->boolean('definite_employment')->default(false);
            $table->date('recruitment_date');
            $table->string('job');
            $table->string('comment')->nullable();

            $table->timestamps();

            $table->integer('principal_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('site_id')->nullable();
        });

        //csekk phone, email, nullable (constraint)
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
