<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class CategoryFactory
 *
 * Фабрика для генерации тестовых категорий.
 *
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Определяет дефолтное состояние для модели Category.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
