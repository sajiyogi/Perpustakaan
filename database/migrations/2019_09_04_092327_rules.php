<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rules extends Migration
{
    public function up()
    {
        Schema::create('Rules', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description')->nullable();
            $table->string('pengesah');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Rules');
    }
}
