<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            //foreign key for category_id
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');
            
            //title, desc, price, quantity, sku, and image.
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->float('price')->unsigned()->nullable();
            $table->bigInteger('quantity')->unsigned()->nullable();
            $table->string('sku', 100);
            $table->string('picture', 150);
            $table->timestamps();
            $table->softDeletes();

            //each entry must have a unique sku.
            $table->unique(['sku']);
            //each entry must have its own combination of category id and title. 2 entries cant have the same.
            $table->unique(['category_id', 'title']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
