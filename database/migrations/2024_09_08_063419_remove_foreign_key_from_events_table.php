<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeyFromEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['host_id']);  // Drop the foreign key constraint
        });
    }

    /**
     * Reverse the migrations (no need to re-add the foreign key).
     *
     * @return void
     */
    public function down()
    {
        // test
    }
}
