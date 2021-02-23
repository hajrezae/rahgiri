<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ghabetoo_trackings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->nullable();
            $table->integer('carrier_id')->nullable();
            $table->dateTime('ship_date')->nullable();
            $table->dateTime('receive_date')->nullable();
            $table->boolean('is_received')->default(false);
            $table->string('tracking_code')->nullable();
            $table->string('tracking_note')->nullable();
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
        Schema::dropIfExists('ghabetoo_trackings');
    }
}
