<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->string('email')->unique(); 
            $table->string('password');
            $table->boolean('is_super')->default(false);
            $table->string('name');
            $table->string('image');
            $table->string('mobile');
            $table->integer('designation')->nullable(true);
            $table->integer('department')->nullable(true);
            $table->integer('unit')->nullable(true);
            $table->integer('section')->nullable(true);
            $table->date('dob')->nullable(true);
            $table->string('address')->nullable(true);
            $table->string('fathers')->nullable(true);
            $table->string('mothers')->nullable(true);
            $table->date('join')->nullable(true);
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
