<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReserveTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserve_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->nullableMorphs('client');
            $table->unsignedBigInteger('space_id')->nullable()->index();
            $table->unsignedInteger('persons')->default(1);
            $table->datetime('reserved_at')->index();
            $table->text('request')->nullable();
            $table->string('status')->index()->nullable();
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
        Schema::dropIfExists('reserve_transactions');
    }
}
