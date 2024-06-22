<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeAndUpdateStatusInCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            // Add the 'type' column with default values 0 or 1
            $table->tinyInteger('type')->default(0)->comment('0: nộp file báo cáo, 1: nộp file đồ án');

            // Update default value of 'status' column to 0
            $table->tinyInteger('status')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendars', function (Blueprint $table) {
            // Remove the 'type' column
            $table->dropColumn('type');

            // Revert the default value of 'status' column (change as needed)
            $table->tinyInteger('status')->default(2)->nullable()->change();
        });
    }
}
