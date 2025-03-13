<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Запускает миграцию: создаёт таблицу товаров.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Первичный ключ
            $table->string('name')->comment('Название товара');
            $table->unsignedBigInteger('category_id')->comment('Идентификатор категории');
            $table->text('description')->nullable()->comment('Описание товара');
            $table->decimal('price', 10, 2)->comment('Цена товара (рубли и копейки)');
            $table->timestamps();

            // Внешний ключ: связываем товар с категорией
            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');
        });
    }

    /**
     * Откатывает миграцию.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
