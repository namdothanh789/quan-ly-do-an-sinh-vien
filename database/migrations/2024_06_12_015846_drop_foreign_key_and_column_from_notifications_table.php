<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignKeyAndColumnFromNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Drop the foreign key constraint
            // $table->dropForeign(['n_course_id']);
            // Drop the column
            $table->dropColumn('n_course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Add the column back
            $table->unsignedBigInteger('n_course_id');
            // Recreate the foreign key constraint
            $table->foreign('n_course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
        });
    }
}
