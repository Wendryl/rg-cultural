<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateActivitesTableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {

            $table->unsignedBigInteger('sub_category_id')->after('user_id');

            $table->string('description')->nullable()->change();
            $table->float('value')->nullable()->change();
            $table->string('value_unity')->nullable()->change();

            $table->string('art_picture_url')->after('value_unity')->nullable();
            $table->string('experience')->after('art_picture_url')->nullable();
            $table->string('facebook_url')->after('experience')->nullable();
            $table->string('instagram_url')->after('facebook_url')->nullable();
            $table->string('youtube_url')->after('instagram_url')->nullable();
            $table->integer('type')->after('youtube_url');
            $table->boolean('approved')->after('type');

            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            $table->foreign('sub_category_id')
                ->references('id')->on('sub_categories')->onDelete('cascade');
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

            $table->string('description')->change();
            $table->float('value')->change();
            $table->string('value_unity')->change();

            $table->dropColumn('art_picture_url');
            $table->dropColumn('experience');
            $table->dropColumn('facebook_url');
            $table->dropColumn('instagram_url');
            $table->dropColumn('youtube_url');
            $table->dropColumn('type');
            $table->dropColumn('approved');

            $table->dropForeign(['sub_category_id']);
            $table->dropColumn('sub_category_id');

            $table->foreign('category_id')
                ->references('id')->on('categories')->onDelete('cascade');
        });
    }
}
