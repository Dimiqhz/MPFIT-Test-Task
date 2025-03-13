<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * Модель товара
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property string|null $description
 * @property float $price
 */
class Product extends Model
{
    protected $fillable = ['name', 'category_id', 'description', 'price'];

    /**
     * Связь: товар принадлежит одной категории.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Связь: товар может быть связан с несколькими заказами.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
