<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMeetingInfoToNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->enum('meeting_type', ['offline', 'online'])->default('offline'); // Trường để xác định buổi họp là online hay offline
            $table->string('location')->nullable()->default('Unknown Location'); // Giá trị mặc định là 'Unknown Location'
            $table->string('location_details')->nullable()->default('No details'); // Giá trị mặc định là 'No details'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn('meeting_type');
            $table->dropColumn('location');
            $table->dropColumn('location_details');
        });
    }
}
