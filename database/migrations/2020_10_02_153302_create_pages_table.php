<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');    
            $table->string('picture');   
            $table->longText('description');
            $table->string('template'); 
            $table->integer('parent_id')->unsigned()->default(0);
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
        Schema::dropIfExists('pages');
    }
}
