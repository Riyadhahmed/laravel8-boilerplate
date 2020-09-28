<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('settings', function (Blueprint $table) {
         $table->increments('id');
         $table->string('name');
         $table->string('slogan')->nullable();
         $table->string('reg')->nullable();
         $table->string('stablished')->nullable();
         $table->string('email')->unique();
         $table->string('contact')->nullable();
         $table->string('address')->nullable();
         $table->string('website')->nullable();
         $table->string('logo')->nullable();
         $table->string('favicon')->nullable();
         $table->string('layout')->default(1);
         $table->string('running_year');
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
      Schema::dropIfExists('settings');
   }
}
