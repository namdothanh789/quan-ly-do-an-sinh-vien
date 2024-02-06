<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationCouncilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_councils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nc_council_id')->nullable();
            $table->foreign('nc_council_id')->references('id')->on('councils')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('nc_notification_id')->nullable();
            $table->foreign('nc_notification_id')->references('id')->on('councils')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('notification_councils');
    }
}
