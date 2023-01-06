<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Posts extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->string('incident_type');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('image_path')->nullable();
            $table->timestamps();
            $table->boolean('legitimacy')->nullable();
            $table->tinyInteger('response_status')->nullable();
            $table->BigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');  
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
