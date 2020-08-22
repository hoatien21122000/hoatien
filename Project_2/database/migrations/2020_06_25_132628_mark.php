<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mark extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //// //tao bang diem
        Schema::create('mark', function (Blueprint $table) {
            $table->integer('subject_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('exam_times')->unsigned();
            $table->float('mark');
            $table->foreign('subject_id')->references('subject_id')->on('subject');
            $table->foreign('student_id')->references('student_id')->on('student');
            $table->primary(['subject_id','student_id','exam_times']);
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
