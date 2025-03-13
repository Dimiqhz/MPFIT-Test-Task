<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * Модель заказа, включает поля, связи и вычисление итоговой цены.
 *
 * @property int $id
 * @property int $product_id
 * @property string $buyer_full_name
 * @property int $quantity
 * @property string $status
 * @property string|null $comment
 */
class Order extends Model
{
    protected $fillable = ['product_id', 'buyer_full_name', 'quantity', 'status', 'comment'];

    /**
     * Связь: заказ принадлежит товару.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Функция для вычисления итоговой цены заказа.
     *
     * @return float Итоговая цена = цена товара * количество
     */
    public function getTotalPriceAttribute(): float
    {
        return $this->product->price * $this->quantity;
    }
}
