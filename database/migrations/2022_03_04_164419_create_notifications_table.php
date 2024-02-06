<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('n_course_id')->nullable();
            $table->foreign('n_course_id')->references('id')->on('courses')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('n_title')->comment('Tiêu đề thông báo');
            $table->tinyInteger('n_type')->default(0)->nullable();
            $table->text('n_content')->nullable()->comment('Nội dung thông báo');
            $table->dateTime('n_from_date')->comment('Bắt đầu từ ngày')->nullable();
            $table->dateTime('n_end_date')->comment('Ngày kết thúc')->nullable();
            $table->tinyInteger('n_send_to')->default(0)->nullable();
            $table->tinyInteger('n_status')->default(0)->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
