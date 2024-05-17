<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_files', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('rf_student_topic_id')->nullable();
            $table->foreign('rf_student_topic_id')->references('id')->on('student_topics')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('rf_title')->nullable();
            $table->string('rf_part_file')->nullable();
            $table->text('rf_comment')->nullable();
            $table->integer('rf_point')->default(0);
            $table->tinyInteger('rf_status')->default(0)->nullable();
            $table->tinyInteger('rf_type')->default(0)->nullable();

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
        Schema::dropIfExists('result_files');
    }
}
