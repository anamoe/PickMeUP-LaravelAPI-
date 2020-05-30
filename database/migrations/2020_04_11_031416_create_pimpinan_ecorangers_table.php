<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePimpinanEcorangersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pimpinan_ecoranger', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('nohp');
            $table->string('alamat');
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('user')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
           
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pimpinan_ecorangers');
    }
}
