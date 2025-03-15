<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ProductTest
 *
 * Тестирование CRUD операций для товаров.
 */
class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тестирует отображение списка товаров.
     *
     * @return void
     */
    public function test_products_index_displays_products(): void
    {
        // Создаём тестовую категорию и товар
        $category = Category::factory()->create(['name' => 'легкий']);
        $product = Product::factory()->create([
            'name' => 'Тестовый товар',
            'category_id' => $category->id,
            'description' => 'Описание товара',
            'price' => 100.00,
        ]);

        $response = $this->get(route('products.index'));
        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($category->name);
    }

    /**
     * Тестирует отображение формы создания товара.
     *
     * @return void
     */
    public function test_create_product_form_is_displayed(): void
    {
        $response = $this->get(route('products.create'));
        $response->assertStatus(200);
        $response->assertSee('Добавить товар');
    }

    /**
     * Тестирует создание нового товара.
     *
     * @return void
     */
    public function test_product_can_be_created(): void
    {
        $category = Category::factory()->create();
        $data = [
            'name' => 'Новый товар',
            'category_id' => $category->id,
            'description' => 'Описание нового товара',
            'price' => 150.50,
        ];

        $response = $this->post(route('products.store'), $data);
        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', ['name' => 'Новый товар']);
    }
    
    // Дополнительные тесты для обновления и удаления можно добавить аналогичным образом
}
