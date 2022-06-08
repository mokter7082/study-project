<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniqueidConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uniqueid_configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model');
            $table->string('key');
            $table->string('uid')->unique(); 
            $table->string('prefix')->nullable();
            $table->string('suffix')->nullable(); 
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
        Schema::dropIfExists('uniqueid_configs');
    }
}
