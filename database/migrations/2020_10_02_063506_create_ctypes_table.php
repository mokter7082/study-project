<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctypes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title'); 
            $table->string('slug');
            $table->text('description')->nullable(true); 
            $table->string('picture')->nullable(true);
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
        Schema::dropIfExists('ctypes');
    }
}
