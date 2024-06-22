<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsFromStudentTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_topics', function (Blueprint $table) {
            // Drop foreign key constraint first
            $table->dropForeign(['st_teacher_instructor_id']);
            // Drop the columns
            $table->dropColumn(['st_teacher_instructor_id', 'st_outline', 'st_outline_part', 'st_status_outline', 'st_comment_outline', 'st_point_outline', 'st_thesis_book', 'st_thesis_book_part', 'st_status_thesis_book', 'st_comment_thesis_book', 'st_point_thesis_book', 'st_status', 'st_comments', 'st_point_medium', ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_topics', function (Blueprint $table) {
            // Add the columns back
            $table->string('st_outline')->nullable()->comment('tiêu đề ,đề cương');
            $table->string('st_outline_part')->nullable()->comment('Đường dẫn lưu trữ');
            $table->tinyInteger('st_status_outline')->default(0)->nullable();
            $table->text('st_comment_outline')->nullable();
            $table->float('st_point_outline', 8, 2)->comment('điểm đề cương')->nullable();

            $table->string('st_thesis_book')->nullable()->comment('tiêu đề quyển báo cáo');
            $table->string('st_thesis_book_part')->nullable()->comment('đường dẫn lưu báo cáo');
            $table->tinyInteger('st_status_thesis_book')->default(0)->nullable();
            $table->text('st_comment_thesis_book')->nullable();
            $table->float('st_point_thesis_book', 8, 2)->comment('điểm báo cáo');
            $table->tinyInteger('st_status')->default(0)->nullable();
            $table->text('st_comments')->nullable();
            $table->float('st_point_medium', 8, 2)->nullable();
            // Add the foreign key column back
            $table->unsignedBigInteger('st_teacher_instructor_id')->nullable();
            // Restore the foreign key constraint
            $table->foreign('st_teacher_instructor_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }
}
