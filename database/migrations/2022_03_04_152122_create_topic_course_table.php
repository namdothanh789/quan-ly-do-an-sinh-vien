<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tc_topic_id')->nullable();
            $table->foreign('tc_topic_id')->references('id')->on('topics')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('tc_course_id')->nullable();
            $table->foreign('tc_course_id')->references('id')->on('courses')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('tc_council_id')->nullable();
            $table->foreign('tc_council_id')->references('id')->on('councils')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('tc_registration_number')->nullable();
            $table->tinyInteger('tc_status')->nullable();
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
        Schema::dropIfExists('topic_course');
    }
}
