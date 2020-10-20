<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompnyRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()


    {
        Schema::create('compny_revenues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('user_id');
            $table->BigInteger('category_id');
            $table->string('image');
            $table->string('notes');
            $table->double('value');
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
        Schema::dropIfExists('compny_revenues');
    }
}
