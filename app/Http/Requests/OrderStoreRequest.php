<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class OrderStoreRequest
 *
 * Валидация данных при создании заказа.
 *
 * @return array Массив правил валидации
 */
class OrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id'      => 'required|exists:products,id',
            'buyer_full_name' => 'required|string|max:255',
            'quantity'        => 'required|integer|min:1',
            'comment'         => 'nullable|string',
        ];
    }
}
