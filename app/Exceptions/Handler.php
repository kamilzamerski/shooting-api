<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * @param Exception $e
     * @throws Exception
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException)
        {
            $errorMsg = "Model not found";
            $errorCode = Response::HTTP_NOT_FOUND;
        }
        elseif ($e instanceof AuthorizationException)
        {
            $errorMsg = "Authorization error";
            $errorCode = Response::HTTP_UNAUTHORIZED;
        }
        elseif ($e instanceof ValidationException)
        {
            $errorMsg = "Validation error";
            $errorCode = Response::HTTP_UNPROCESSABLE_ENTITY;
        }
        else {
            $errorMsg = "Internal server error";
            $errorCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        return response()->json(['status' => false, 'msg' => $errorMsg], $errorCode);
    }
}
