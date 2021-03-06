<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function render($request, \Throwable $exception): Response {
        if ($exception instanceof HttpException) {
            return new Response([
                'status' => $exception->getStatusCode(),
                'message' => $exception->getMessage()
            ], $exception->getStatusCode());
        }
        if ($exception instanceof ValidationException) {
            return new Response([
                'status' => 400,
                'type' => 'ValidationException',
                'message' => 'Validation error',
                'errors' => $exception->errors()
            ], 400);
        }
        return parent::render($request, $exception);
    }
}
