<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(fn () => true);

        $exceptions->render(function (HttpExceptionInterface $e, Request $request) {
            $message = match ($e->getStatusCode()) {
                403 => 'You are not allowed to do this.',
                404 => 'Data not found.',
                405 => 'Method not allowed.',
                default => $e->getMessage() ?: 'Something went wrong.',
            };

            return response()->json(['message' => $message], $e->getStatusCode());
        });

        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                'message' => 'Something error please check it',
                'errors' => collect($e->errors())->map(fn ($messages) => $messages[0]),
            ], $e->status);
        });
    })->create();
