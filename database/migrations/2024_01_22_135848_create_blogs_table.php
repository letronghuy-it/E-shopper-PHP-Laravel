<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('description');
            $table->longText('content')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
