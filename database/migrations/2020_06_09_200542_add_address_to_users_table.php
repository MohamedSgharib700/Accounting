<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('address')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
//            $table->foreign('created_by')
//                ->references('id')->on('users')
//                ->onUpdate('set null')
//                ->onDelete('set null');

            $table->unsignedBigInteger('pos_id')->nullable();
//            $table->foreign('pos_id')
//                ->references('id')->on('pos')
//                ->onUpdate('set null')
//                ->onDelete('set null');

            $table->string('card_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
