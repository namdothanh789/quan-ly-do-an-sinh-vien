<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('nu_notification_id')->nullable();
            $table->foreign('nu_notification_id')->references('id')->on('notifications')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('nu_user_id')->nullable();
            $table->foreign('nu_user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('nu_type_user')->default(0)->nullable();
            $table->tinyInteger('nu_status')->default(0)->nullable();
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
        Schema::dropIfExists('notification_users');
    }
}
