<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Запускает миграцию: создаёт таблицу заказов.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Первичный ключ
            $table->unsignedBigInteger('product_id')->comment('Идентификатор товара');
            $table->string('buyer_full_name')->comment('ФИО покупателя');
            $table->unsignedInteger('quantity')->default(1)->comment('Количество товара');
            $table->enum('status', ['new', 'completed'])->default('new')->comment('Статус заказа');
            $table->text('comment')->nullable()->comment('Комментарий покупателя');
            $table->timestamps(); // Поле created_at (как дата создания заказа)

            // Внешний ключ: связываем заказ с товаром
            $table->foreign('product_id')
                  ->references('id')->on('products')
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
        Schema::dropIfExists('orders');
    }
}
