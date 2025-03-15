<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class OrderTest
 *
 * Тестирование функционала заказов.
 */
class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тестирует отображение списка заказов.
     *
     * @return void
     */
    public function test_orders_index_displays_orders(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $order = Order::factory()->create([
            'product_id' => $product->id,
            'buyer_full_name' => 'Иван Иванов',
            'quantity' => 2,
            'status' => 'new'
        ]);

        $response = $this->get(route('orders.index'));
        $response->assertStatus(200);
        $response->assertSee((string)$order->id);
        $response->assertSee($order->buyer_full_name);
    }

    /**
     * Тестирует отображение формы создания заказа.
     *
     * @return void
     */
    public function test_create_order_form_is_displayed(): void
    {
        $response = $this->get(route('orders.create'));
        $response->assertStatus(200);
        $response->assertSee('Создать заказ');
    }

    /**
     * Тестирует создание нового заказа.
     *
     * @return void
     */
    public function test_order_can_be_created(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $data = [
            'product_id'      => $product->id,
            'buyer_full_name' => 'Петр Петров',
            'quantity'        => 3,
            'comment'         => 'Комментарий к заказу'
        ];

        $response = $this->post(route('orders.store'), $data);
        $response->assertRedirect(route('orders.index'));
        $this->assertDatabaseHas('orders', ['buyer_full_name' => 'Петр Петров']);
    }

    // Тест обновления статуса заказа.

    /**
     * Тестирует обновление статуса заказа.
     *
     * @return void
     */
    public function test_order_status_can_be_updated(): void
    {
        // Создаем тестовую категорию и товар
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        
        // Создаем заказ со статусом "new"
        $order = Order::factory()->create([
            'product_id'      => $product->id,
            'buyer_full_name' => 'Test Buyer',
            'quantity'        => 1,
            'status'          => 'new',
        ]);

        // Обновляем статус заказа на "completed"
        $newStatus = 'completed';
        $response = $this->patch(route('orders.updateStatus', $order), ['status' => $newStatus]);
        
        // Проверяем редирект на страницу подробного просмотра заказа
        $response->assertRedirect(route('orders.show', $order));

        // Проверяем, что в базе данных статус обновился
        $this->assertDatabaseHas('orders', [
            'id'     => $order->id,
            'status' => $newStatus,
        ]);
    }
}
