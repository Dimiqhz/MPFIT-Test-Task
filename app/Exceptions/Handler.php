<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class Handler extends ExceptionHandler
{
    /**
     * Список исключений, которые не нужно логировать.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        // Здесь можно добавить исключения, которые не нужно логировать
    ];

    /**
     * Список входных данных, которые никогда не должны сохраняться в сессии в случае ошибки валидации.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Переопределяем метод render для возврата JSON-ответов в API.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Throwable $exception)
    {
        // Если запрос ожидает JSON (например, для API)
        if ($request->expectsJson()) {
            // Обработка ошибок валидации
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'error'   => true,
                    'message' => 'Ошибка валидации',
                    'errors'  => $exception->errors(),
                ], 422);
            }

            // Получение HTTP-кода ошибки, если он определён, иначе 500
            $status = 500;
            if ($exception instanceof HttpExceptionInterface) {
                $status = $exception->getStatusCode();
            }

            // Формирование JSON-ответа об ошибке
            return response()->json([
                'error'   => true,
                'message' => $exception->getMessage() ?: 'Произошла ошибка',
            ], $status);
        }

        // Для обычных (не API) запросов используем родительский метод
        return parent::render($request, $exception);
    }
}
