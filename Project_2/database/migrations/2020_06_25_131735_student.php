<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //   //tao bang sinh vien
       Schema::create('student', function (Blueprint $table) {
        $table->increments('student_id');
        $table->integer('class_id')->unsigned();
        $table->string('student_name',100);
        $table->text('address');
        $table->string('student_phone_number',10);
        $table->string('email',50)->unique();
        $table->string('password',100);
        $table->foreign('class_id')->references('class_id')->on('classes');
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
