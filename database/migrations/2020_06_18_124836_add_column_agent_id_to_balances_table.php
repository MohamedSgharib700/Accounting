<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAgentIdToBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::create('areas', function (Blueprint $table) {
        //$table->bigIncrements('id');
        //$table->string('name');
        // $table->timestamps();
        //Schema::table('balances', function (Blueprint $table) {
        // $table->unsignedBigInteger('agent_id')->nullable()->after('id');
        // $table->unsignedBigInteger('customer_id')->nullable()->after('agent_id');
        //});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('areas');
        //Schema::table('balances', function (Blueprint $table) {
        // $table->dropColumn('agent_id');
        // $table->dropColumn('customer_id');
        //});
    }

}
