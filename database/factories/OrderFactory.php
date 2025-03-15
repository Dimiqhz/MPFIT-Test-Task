<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class OrderFactory
 *
 * Фабрика для генерации тестовых заказов.
 *
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Определяет дефолтное состояние для модели Order.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(), 
            'buyer_full_name' => $this->faker->name, 
            'quantity' => $this->faker->numberBetween(1, 10), 
            'status' => 'new',                             
            'comment' => $this->faker->optional()->sentence, 
        ];
    }
}
