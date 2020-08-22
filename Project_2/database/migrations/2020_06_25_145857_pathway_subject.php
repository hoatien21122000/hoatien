<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PathwaySubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //tao bang phu nganh_mon
        Schema::create('pathway_subject', function (Blueprint $table) {
            $table->integer('pathway_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->foreign('pathway_id')->references('pathway_id')->on('pathway');
            $table->foreign('subject_id')->references('subject_id')->on('subject');
            $table->primary(['pathway_id','subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
