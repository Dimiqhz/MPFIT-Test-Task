<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class OrderStatusUpdateRequest
 *
 * Валидация данных при обновлении статуса заказа.
 *
 * @return array Массив правил валидации
 */
class OrderStatusUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:new,completed',
        ];
    }
}
