<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CategoryTest
 *
 * Тестирование CRUD операций для категорий.
 */
class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тестирует отображение списка категорий.
     *
     * @return void
     */
    public function test_categories_index_displays_categories(): void
    {
        $category = Category::factory()->create(['name' => 'легкий']);
        $response = $this->get(route('categories.index'));
        $response->assertStatus(200);
        $response->assertSee($category->name);
    }

    /**
     * Тестирует отображение формы создания категории.
     *
     * @return void
     */
    public function test_create_category_form_is_displayed(): void
    {
        $response = $this->get(route('categories.create'));
        $response->assertStatus(200);
        $response->assertSee('Добавить категорию');
    }

    /**
     * Тестирует создание новой категории.
     *
     * @return void
     */
    public function test_category_can_be_created(): void
    {
        $data = ['name' => 'новая категория'];
        $response = $this->post(route('categories.store'), $data);
        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', ['name' => 'новая категория']);
    }
}
