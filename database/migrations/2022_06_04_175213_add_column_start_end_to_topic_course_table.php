<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStartEndToTopicCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topic_course', function (Blueprint $table) {
            //
            $table->dateTime('tc_start_outline')->after('tc_end_time')->nullable();
            $table->dateTime('tc_end_outline')->after('tc_start_outline')->nullable();

            $table->dateTime('tc_start_thesis_book')->after('tc_end_outline')->nullable();
            $table->dateTime('tc_end_thesis_book')->after('tc_start_thesis_book')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topic_course', function (Blueprint $table) {
            //
        });
    }
}
