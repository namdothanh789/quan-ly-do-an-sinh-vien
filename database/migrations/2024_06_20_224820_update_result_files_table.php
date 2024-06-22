<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateResultFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('result_files', function (Blueprint $table) {
            // Thêm cột calendar_id
            $table->unsignedBigInteger('calendar_id')->after('id');
            
            // Tạo khóa ngoại cho calendar_id
            $table->foreign('calendar_id')->references('id')->on('calendars')->onUpdate('cascade')->onDelete('cascade');
            
            // Xóa cột rf_student_topic_id
            $table->dropForeign(['rf_student_topic_id']);
            $table->dropColumn('rf_student_topic_id');
            
            // Xóa cột rf_part_file_feedback
            $table->dropColumn('rf_part_file_feedback');

            // Xóa cột rf_status
            $table->dropColumn('rf_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('result_files', function (Blueprint $table) {
            // Thêm lại cột rf_student_topic_id
            $table->unsignedBigInteger('rf_student_topic_id')->after('id');
            
            // Tạo lại khóa ngoại cho rf_student_topic_id
            $table->foreign('rf_student_topic_id')->references('id')->on('student_topics')
                ->onUpdate('cascade')->onDelete('cascade');
            
            // Thêm lại cột rf_part_file_feedback
            $table->text('rf_part_file_feedback')->after('rf_part_file');

            // Thêm lại cột rf_status
            $table->tinyInteger('rf_status')->default(0)->nullable()->after('rf_point');

            // Xóa cột calendar_id
            $table->dropForeign(['calendar_id']);
            $table->dropColumn('calendar_id');
        });
    }
}
