<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundMoneyFromClientToDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_money_from_client_to_delegates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('pos_id');
            $table->unsignedBigInteger('delegate_id');
            $table->double('value');
            $table->unsignedBigInteger('created_by');
            $table->dateTime('created_date');
            $table->tinyInteger('status',false,true)->default(0);
            $table->unsignedBigInteger('done_from_id')->nullable();
            $table->dateTime('done_date')->nullable();

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
        Schema::dropIfExists('refund_money_from_client_to_delegates');
    }
}
