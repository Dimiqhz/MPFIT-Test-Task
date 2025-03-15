<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Подключаем фасад логирования

/**
 * Class ProductController
 *
 * Контроллер для управления CRUD операциями с товарами.
 */
class ProductController extends Controller
{
    /**
     * Отображает список товаров с информацией о категории.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Фильтрация по категории, если передан параметр
        if ($request->has('category')) {
            $query->where('category_id', $request->get('category'));
        }

        // Пагинация: 10 товаров на страницу
        $products = $query->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Показывает форму для создания нового товара.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Сохраняет новый товар в базе данных.
     *
     * @param ProductStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());
        Log::info('Товар создан', ['id' => $product->id, 'name' => $product->name]);
        return redirect()->route('products.index')
                         ->with('success', 'Товар успешно создан');
    }

    /**
     * Отображает детальную информацию о товаре.
     *
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Показывает форму для редактирования товара.
     *
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Обновляет информацию о товаре.
     *
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->validated());
        Log::info('Товар обновлён', ['id' => $product->id, 'name' => $product->name]);
        return redirect()->route('products.index')
                         ->with('success', 'Товар успешно обновлён');
    }

    /**
     * Удаляет товар из базы данных.
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $productId = $product->id;
        $product->delete();
        Log::info('Товар удалён', ['id' => $productId]);
        return redirect()->route('products.index')
                         ->with('success', 'Товар успешно удалён');
    }
}
