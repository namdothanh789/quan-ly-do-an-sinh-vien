<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimeRegisterToTopicCourseTable extends Migration
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
            $table->dateTime('tc_start_time')->after('tc_teacher_id')->nullable();
            $table->dateTime('tc_end_time')->after('tc_start_time')->nullable();
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
