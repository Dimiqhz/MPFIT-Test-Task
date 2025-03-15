<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ProductTest
 *
 * Юнит-тест для проверки связи модели Product с Category.
 */
class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тестирует, что товар принадлежит категории.
     *
     * @return void
     */
    public function test_product_belongs_to_category(): void
    {
        // Создаем категорию
        $category = Category::factory()->create();

        // Создаем товар, привязанный к созданной категории
        $product = Product::factory()->create([
            'category_id' => $category->id,
        ]);

        // Проверяем, что связь product->category возвращает экземпляр Category
        $this->assertInstanceOf(Category::class, $product->category);
    }
}
