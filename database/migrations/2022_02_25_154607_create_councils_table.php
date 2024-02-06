<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouncilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('councils', function (Blueprint $table) {
            $table->id();
            $table->string('co_title', 255)->comment('tên hội đồng');
            $table->text('co_content')->nullable()->comment('Nội dung quyết định thành lập hội đồng');
            $table->unsignedBigInteger('co_course_id')->nullable();
            $table->foreign('co_course_id')->references('id')->on('courses')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('co_status')->default(2);
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
        Schema::dropIfExists('group_topics');
    }
}
