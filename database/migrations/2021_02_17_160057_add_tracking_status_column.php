<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrackingStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ghabetoo_trackings', function (Blueprint $table) {
            $table->enum('status', ['packing', 'delivering', 'delivered', 'rejected', 'processing'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ghabetoo_trackings', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
