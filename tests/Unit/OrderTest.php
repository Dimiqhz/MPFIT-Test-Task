<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class OrderTest
 *
 * Юнит-тест для модели Order.
 */
class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тестирует корректное вычисление итоговой цены заказа.
     *
     * @return void
     */
    public function test_total_price_accessor_returns_correct_value(): void
    {
        // Создаём категорию
        $category = Category::factory()->create();

        // Создаём товар с фиксированной ценой и привязкой к категории
        $product = Product::factory()->create([
            'price' => 100.50,
            'category_id' => $category->id,
        ]);

        // Создаём заказ с количеством 3
        $order = Order::factory()->create([
            'product_id' => $product->id,
            'quantity'   => 3,
        ]);

        // Ожидаемая итоговая цена = цена товара * количество
        $expectedTotal = 100.50 * 3;

        // Проверяем, что аксессор total_price возвращает правильное значение
        $this->assertEquals($expectedTotal, $order->total_price);
    }
}
