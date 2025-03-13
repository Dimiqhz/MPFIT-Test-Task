<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * Модель категории
 *
 * @property int $id
 * @property string $name
 */
class Category extends Model
{
    // Разрешённое для массового заполнения
    protected $fillable = ['name'];

    /**
     * Связь: категория имеет много товаров.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
