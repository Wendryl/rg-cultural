<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {

            $table->unsignedBigInteger('category_id')->after('user_id');
            $table->dropForeign(['sub_category_id']);
            $table->dropColumn('sub_category_id');

            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
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
        Schema::table('activities', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_category_id')->after('user_id');
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            $table->foreign('sub_category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('cascade');
        });
    }
}
