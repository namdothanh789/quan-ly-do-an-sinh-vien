<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('t_title', 255);
            $table->integer('t_registration_number')->default(0)->nullable();

            $table->unsignedBigInteger('t_department_id')->nullable();
            $table->foreign('t_department_id')->references('id')->on('departments')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->text('t_content')->nullable()->comment('Mô tả đề tài');

            $table->tinyInteger('t_status')->nullable();
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
        Schema::dropIfExists('topics');
    }
}
