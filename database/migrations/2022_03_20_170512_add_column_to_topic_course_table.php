<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTopicCourseTable extends Migration
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
            $table->unsignedBigInteger('tc_department_id')->after('tc_council_id')->nullable();
            $table->foreign('tc_department_id')->references('id')->on('departments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('tc_teacher_id')->after('tc_department_id')->nullable();
            $table->foreign('tc_teacher_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
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
