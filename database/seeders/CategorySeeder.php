<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

/**
 * Class CategorySeeder
 *
 * Заполняет таблицу категорий начальными значениями
 */
class CategorySeeder extends Seeder
{
    /**
     * Запускает сидер для категорий
     *
     * @return void
     */
    public function run()
    {
        $categories = ['легкий', 'хрупкий', 'тяжелый'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
