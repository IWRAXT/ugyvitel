<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('account_number');
            $table->string('comment')->nullable();
            $table->integer('sum');

            $table->integer('site_id')->nullable();
            $table->foreign('site_id')
                ->references('id')
                ->on('sites');
            $table->integer('supplier_id')->nullable();
            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers');
            $table->integer('cost_type_id')->nullable();
            $table->foreign('cost_type_id')
                ->references('id')
                ->on('cost_types');
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
        Schema::dropIfExists('costs');
    }
}
