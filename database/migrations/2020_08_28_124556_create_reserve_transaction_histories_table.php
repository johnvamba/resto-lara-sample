<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReserveTransactionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserve_transaction_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reserve_transaction_id')->index();
            $table->unsignedBigInteger('admin_id')->index()->nullable();
            $table->string('status')->default('pending')->index();
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('reserve_transaction_histories');
    }
}
