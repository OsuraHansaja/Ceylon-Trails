<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportIssuesTable extends Migration
{
    public function up()
    {
        Schema::create('report_issues', function (Blueprint $table) {
            $table->id();
            $table->text('issue');
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('report_issues');
    }
}
