<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent'); 
            $table->integer('sort_number'); 
            $table->enum('menu_type', ['main','footer','left','right'])->default('main');
            $table->string('title'); 
            $table->string('link'); 
            $table->string('icon');
            $table->enum('target', ['_self','_blank','_parent','_top'])->default('_self'); 
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
        Schema::dropIfExists('menus');
    }
}
