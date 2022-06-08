<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('course_id')->unsigned();  
            $table->unsignedBigInteger('user_id')->unsigned();   
            $table->unsignedBigInteger('voucher_id')->unsigned();
            $table->dateTime('day_from', 0); 
            $table->dateTime('day_to', 0);
            $table->enum('ticket_type', ['Single', 'Pair'])->default('Single');  
            $table->decimal('price', 8, 2);  
            $table->text('description');
            $table->enum('status', ['Draft', 'Processing', 'Complete'])->default('Draft'); 
            $table->integer('created_by')->nullable(true); 
            $table->integer('updated_by')->nullable(true);  
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('bookings');
    }
}
