<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->unique();
            $table->foreignId('asset_id');
            $table->foreignId('purpose_id');
            $table->longText('purpose_desc');
            $table->date('estimate_return_at', $precision = 0);
            $table->foreignId('order_user_id');
            $table->date('order_at', $precision = 0);
            $table->foreignId('adm_user_id')->nullable()->default(0);
            $table->date('adm_at', $precision = 0)->nullable()->default(null);
            $table->longText('adm_note')->nullable()->default(null);
            $table->foreignId('app_user_id')->nullable()->default(0);
            $table->date('app_at', $precision = 0)->nullable()->default(null);
            $table->longText('app_note')->nullable()->default(null);
            $table->foreignId('disapp_user_id')->nullable()->default(0);
            $table->date('disapp_at', $precision = 0)->nullable()->default(null);
            $table->longText('disapp_note')->nullable()->default(null);
            $table->foreignId('return_user_id')->nullable()->default(0);
            $table->date('return_at', $precision = 0)->nullable()->default(null);
            $table->longText('return_note')->nullable()->default(null);
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
        Schema::dropIfExists('transactions');
    }
}
