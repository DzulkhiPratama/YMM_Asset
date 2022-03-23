<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->text('asset_id')->unique();
            $table->foreignId('user_id');
            $table->foreignId('type_id');
            $table->text('asset_name');
            $table->longText('asset_desc');
            $table->date('added_at', $precision = 0);
            $table->date('expired_date', $precision = 0)->nullable();
            $table->float('asset_price', 12, 2)->nullable();
            $table->foreignId('mis_id')->nullable();
            $table->longText('couse_exist');
            $table->foreignId('status_id');
            $table->foreignId('location_id');
            $table->longText('asset_log');
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
        Schema::dropIfExists('assets');
    }
}
