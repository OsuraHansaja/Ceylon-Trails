<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // The reviewer (tourist)
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade'); // The item being reviewed
            $table->integer('rating')->unsigned()->default(1); // Rating from 1 to 5
            $table->text('review')->nullable(); // The review text (optional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
