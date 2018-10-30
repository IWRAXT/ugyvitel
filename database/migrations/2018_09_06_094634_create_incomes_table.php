<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('comment')->nullable();
            $table->integer('sum');

            $table->integer('site_id')->nullable();
            $table->foreign('site_id')
                ->references('id')
                ->on('sites');
            $table->integer('client_id')->nullable();;
            $table->foreign('client_id')
                ->references('id')
                ->on('clients');
            $table->integer('income_type_id')->nullable();;
            $table->foreign('income_type_id')
                ->references('id')
                ->on('income_types');

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
        Schema::dropIfExists('incomes');
    }
}
