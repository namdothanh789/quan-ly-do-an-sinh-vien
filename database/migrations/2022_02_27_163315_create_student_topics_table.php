<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_topics', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('st_student_id')->nullable();
            $table->foreign('st_student_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('st_topic_id')->nullable();
            $table->foreign('st_topic_id')->references('id')->on('topics')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('st_teacher_id')->nullable();
            $table->foreign('st_teacher_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('st_teacher_instructor_id')->nullable();
            $table->foreign('st_teacher_instructor_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('st_course_id')->nullable();
            $table->foreign('st_course_id')->references('id')->on('courses')
                ->onUpdate('cascade')->onDelete('cascade');

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
            $table->float('st_point', 8, 2)->comment('điểm bảo vệ')->nullable();
            $table->float('st_point_medium', 8, 2)->nullable();
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
        Schema::dropIfExists('student_topics');
    }
}
