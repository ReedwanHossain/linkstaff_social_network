<?php

namespace App\Exceptions;
use Exception;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Facades\ResponseGenerator;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
        // reportable
        $this->renderable(function (Throwable $e) {
            //
            return response(['error' => $e->getMessage()], $e->getCode() ?: 400);
        });
    }




}
