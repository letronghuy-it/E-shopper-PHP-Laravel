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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('tax_code');
            $table->string('name_company');
            $table->string('representative');
            $table->integer('phone_number')->nullable();
            $table->string('email_address');
            $table->string('address');
            $table->string('nick_name')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
};
