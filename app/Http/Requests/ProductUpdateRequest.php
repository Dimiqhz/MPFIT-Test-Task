<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductUpdateRequest
 *
 * Валидация данных при обновлении товара.
 *
 * @return array Массив правил валидации
 */
class ProductUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'description' => 'nullable|string',
            'price'       => 'sometimes|required|numeric|min:0',
        ];
    }
}
