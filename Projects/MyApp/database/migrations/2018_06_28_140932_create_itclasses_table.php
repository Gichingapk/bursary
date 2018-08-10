<?php

use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItclassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itclasses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usernames');
            $table->string('regno');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itclasses');
    }
}
