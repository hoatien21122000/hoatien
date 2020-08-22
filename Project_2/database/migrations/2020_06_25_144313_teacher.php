<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Teacher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // tao bang giao vien
        Schema::create('teacher', function (Blueprint $table) {
            $table->string('teacher_name', 50);
            $table->string('teacher_phone_number',10);
            $table->string('email',50);
            $table->primary(['email']);
            $table->string('password',100);
            $table->boolean('sex');
            $table->text('address');
            $table->date('date_of_birth');

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
