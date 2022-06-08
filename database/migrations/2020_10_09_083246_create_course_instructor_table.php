<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseInstructorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_instructor', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('course_id'); 
            $table->foreign('course_id')->references('id')->on('courses'); 
            $table->unsignedBigInteger('instructor_id'); 
            $table->foreign('instructor_id')->references('id')->on('instructors');  
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
        Schema::dropIfExists('course_instructor');
    }
}
