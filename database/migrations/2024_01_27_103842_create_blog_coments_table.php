<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_coments', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->integer('id_blog');
            $table->integer('id_user');
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->unsignedInteger('level')->default(0);
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
        Schema::dropIfExists('blog_coments');
    }
};
