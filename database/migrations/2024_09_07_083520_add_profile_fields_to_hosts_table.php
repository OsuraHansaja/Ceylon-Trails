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
        Schema::table('hosts', function (Blueprint $table) {
            $table->string('profile_picture')->nullable();
            $table->string('website_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->text('bio')->nullable();
        });
    }

    public function down()
    {
        Schema::table('hosts', function (Blueprint $table) {
            $table->dropColumn('profile_picture');
            $table->dropColumn('website_url');
            $table->dropColumn('instagram_url');
            $table->dropColumn('facebook_url');
            $table->dropColumn('bio');
        });
    }

};
