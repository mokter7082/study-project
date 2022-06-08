<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->time('start_time', 0); 
            $table->time('end_time', 0);
            $table->string('duration'); 
            $table->dateTime('available', 0); 
            $table->string('class_type');
            $table->decimal('single_price', 8, 2);
            $table->decimal('pair_price', 8, 2); 
            $table->string('picture');
            $table->string('latitude'); 
            $table->string('longitude'); 
            $table->decimal('zoom', 3, 0);  
            $table->longText('description');
            $table->enum('status', ['Active', 'Inactive', 'Delete'])->default('Active'); 
            $table->integer('created_by')->nullable(true); 
            $table->integer('updated_by')->nullable(true); 
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
        Schema::dropIfExists('courses');
    }
}
