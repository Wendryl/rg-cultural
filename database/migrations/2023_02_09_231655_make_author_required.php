<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeAuthorRequired extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cultural_columns', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cultural_columns', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->nullable()->change();
        });
    }
}
