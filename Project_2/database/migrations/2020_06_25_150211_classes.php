<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Classes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // //tao bang lop
         Schema::create('classes', function (Blueprint $table) {
            $table->increments('class_id');
            $table->integer('academic_year_id')->unsigned();
            $table->integer('pathway_id')->unsigned();
            $table->string('class_name',50);
            $table->foreign('academic_year_id')->references('academic_year_id')->on('academic_year');
            $table->foreign('pathway_id')->references('pathway_id')->on('pathway');
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
