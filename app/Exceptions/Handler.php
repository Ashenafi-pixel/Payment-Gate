<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Throwable;
use ErrorException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        if ($exception instanceof AuthenticationException) {
            return response()->view('errors.401', [], 401);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->view('errors.403', [], 403);
        }

        if ($exception instanceof TokenMismatchException) {
            return response()->view('errors.419', [], 419);
        }

        if ($exception instanceof TooManyRequestsHttpException) {
            return response()->view('errors.429', [], 429);
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->view('errors.custom', ['message' => 'The requested resource was not found.'], 404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->view('errors.custom', ['message' => 'The Action is not allowed.'], 405);
        }
        
        // Handle the "Attempt to read property on null" error specifically
        if ($exception instanceof ErrorException && strpos($exception->getMessage(), 'Attempt to read property') !== false) {
            // Log the error for debugging purposes if needed
            // Log::error($exception->getMessage(), ['exception' => $exception]);

            // Return a custom error response
            return response()->view('errors.custom', ['message' => 'An error occurred. Please try again.'], 500);
        }

        return parent::render($request, $exception);
    }
}
