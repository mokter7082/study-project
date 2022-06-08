<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCagetoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cagetories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent')->default(0);
            $table->string('title');
            $table->string('slug');
            $table->string('description')->nullable(true); 
            $table->string('picture')->nullable(true); 

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
        Schema::dropIfExists('cagetories');
    }
}
