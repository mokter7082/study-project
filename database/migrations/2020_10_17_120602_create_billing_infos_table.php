<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('anrede');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('postcode');
            $table->string('city');
            $table->string('phone');   
            $table->date('date_of_birth', 0);  
            $table->string('picture');  
            $table->enum('billing_type', ['Einzelperson', 'Paar'])->default('Einzelperson');
            $table->enum('status', ['Active', 'Inactive', 'Delete'])->default('Active');
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
        Schema::dropIfExists('billing_infos');
    }
}
