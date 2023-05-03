<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartyAccountTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('party_account_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('party_transaction_id')->unsigned();
            $table->bigInteger('account_id')->unsigned();
            $table->integer('dr')->unsigned();
            $table->integer('cr')->unsigned();
            $table->boolean('is_active')->default(ACTIVE_RECORD);
            $table->boolean('is_show')->default(HIDE_RECORD);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('party_account_transactions', function (Blueprint $table) {
            $table->foreign('party_transaction_id')->references('id')->on('party_transactions')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('party_account_transactions');
    }
}
