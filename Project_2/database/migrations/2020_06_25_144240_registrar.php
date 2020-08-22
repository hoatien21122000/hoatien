<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Registrar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // tao bang giao vu
        Schema::create('registrar', function (Blueprint $table) {
            $table->string('registrar_name', 50);
            $table->string('registrar_phone_number',10);
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
