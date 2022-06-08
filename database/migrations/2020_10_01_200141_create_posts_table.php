<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');    
            $table->string('picture');   
            $table->longText('description');
            $table->enum('post_type', ['Page', 'Post'])->default('Page');
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
        Schema::dropIfExists('posts');
    }
}
