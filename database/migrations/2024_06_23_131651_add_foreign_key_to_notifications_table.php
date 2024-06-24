<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Đổi data type của cột n_user_id để khớp với data type của cột users.id
            $table->unsignedBigInteger('n_user_id')->change();
            // Thêm khóa ngoại
            $table->foreign('n_user_id')
                  ->references('id')
                  ->on('users')
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
        Schema::table('notifications', function (Blueprint $table) {
            // Xóa khóa ngoại
            $table->dropForeign(['n_user_id']);
            // Trả lại kiểu dữ liệu ban đầu
            $table->bigInteger('n_user_id')->change();
        });
    }
}
