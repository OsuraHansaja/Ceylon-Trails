<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('thumbnail_image');
            $table->dropColumn('cover_photo');
        });
    }

    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('thumbnail_image')->nullable();
            $table->string('cover_photo')->nullable();
        });
    }

};
