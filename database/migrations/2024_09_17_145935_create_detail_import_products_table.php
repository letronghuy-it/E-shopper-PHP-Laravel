<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('detail_import_products', function (Blueprint $table) {
            $table->id();
            $table->integer('id_product');
            $table->string('name_product');
            $table->integer('quantity_import');
            $table->double('price_import');
            $table->double('Total_amount');
            $table->integer('id_import_product')->default(0);
            $table->string('note_import_product')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_import_products');
    }
};
