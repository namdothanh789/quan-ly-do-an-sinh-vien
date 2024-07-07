<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromTopicCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topic_course', function (Blueprint $table) {
            $table->dropColumn([
                'tc_start_outline',
                'tc_end_outline',
                'tc_start_thesis_book',
                'tc_end_thesis_book'
            ]);
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
            $table->dateTime('tc_start_outline')->nullable();
            $table->dateTime('tc_end_outline')->nullable();
            $table->dateTime('tc_start_thesis_book')->nullable();
            $table->dateTime('tc_end_thesis_book')->nullable();
        });
    }
}
