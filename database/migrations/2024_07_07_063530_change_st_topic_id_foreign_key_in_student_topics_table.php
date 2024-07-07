<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStTopicIdForeignKeyInStudentTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_topics', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['st_topic_id']);

            // Add the new foreign key constraint
            $table->foreign('st_topic_id')
                  ->references('id')
                  ->on('topic_course')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
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
            // Drop the new foreign key constraint
            $table->dropForeign(['st_topic_id']);

            // Re-add the original foreign key constraint
            $table->foreign('st_topic_id')
                  ->references('id')
                  ->on('topics')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }
}
