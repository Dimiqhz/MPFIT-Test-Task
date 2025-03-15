<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ProductFactory
 *
 * Фабрика для генерации тестовых товаров.
 *
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Определяет дефолтное состояние для модели Product.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true), // Генерирует случайное название из 3 слов
            'category_id' => Category::factory(),     // Создает категорию, если не передано вручную
            'description' => $this->faker->sentence,    // Генерирует описание товара
            'price' => $this->faker->randomFloat(2, 10, 1000), // Цена от 10 до 1000 рублей с 2 знаками после запятой
        ];
    }
}
