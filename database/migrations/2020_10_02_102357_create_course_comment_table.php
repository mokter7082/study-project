<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('course_cmment', function (Blueprint $table) { 
            $table->bigIncrements('id');

            $table->unsignedBigInteger('course_id'); 
            $table->foreign('course_id')->references('id')->on('courses');

            $table->unsignedBigInteger('comment_id'); 
            $table->foreign('comment_id')->references('id')->on('comments'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_cmment');

        // Schema::table('course_cmment', function (Blueprint $table) { 
        // });
    }
}
