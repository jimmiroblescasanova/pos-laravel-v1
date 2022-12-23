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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->unique();
            $table->string('name');
            $table->string('supplier_code')->nullable();
            $table->integer('cost')->default(0);
            $table->integer('price')->default(0);
            $table->integer('inventory')->default(0);
            $table->integer('minimum')->default(0);
            $table->boolean('active')->default(1);
            $table->longText('description')->nullable();
            $table->bigInteger('total_sales')->default(0); // para contar el más vendido
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
        Schema::dropIfExists('products');
    }
};
