<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->references('id')->on('product_categories')->onDelete('CASCADE');
            $table->string('name');
            $table->string('type');
            $table->boolean('required');
            $table->json('variants');
            $table->integer('sort');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produc_attributes');
    }
}
