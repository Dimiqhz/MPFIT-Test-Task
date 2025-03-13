<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductStoreRequest
 *
 * Валидация данных при создании нового товара.
 *
 * @return array Массив правил валидации
 */
class ProductStoreRequest extends FormRequest
{
    /**
     * Разрешено ли выполнение запроса.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации для создания товара.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
        ];
    }
}
