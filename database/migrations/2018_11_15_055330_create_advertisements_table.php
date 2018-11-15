<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('category');
            $table->string('slug',191)->unique();
            $table->string('header_top')->nullable();
            $table->string('body_top')->nullable();
            $table->string('body_middle')->nullable();
            $table->string('body_bottom')->nullable();
            $table->string('sidebar_one')->nullable();
            $table->string('sidebar_two')->nullable();
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
        Schema::dropIfExists('advertisements');
    }
}
