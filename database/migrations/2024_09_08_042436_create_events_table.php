<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('small_description');
            $table->string('location');
            $table->string('link')->nullable();
            $table->string('thumbnail_image');
            $table->text('large_description');
            $table->unsignedBigInteger('host_id'); // Foreign key for host user
            $table->foreign('host_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}

