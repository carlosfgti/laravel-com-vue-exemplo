<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if( $exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException ) {
            if ($request->ajax())
                return response()->json(['error' => 'not_found_uri'], 404);

            // Redireciona caso a requisição não seja em AJAX (Evita problema de rotas no Vue SPA)
            return redirect()->route('home');
        }
        
        if( $exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException )
            return response()->json(['error' => 'method_not_allowed'], 405);

        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            return response()->json(['token_expired'], $exception->getStatusCode());
        
        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            return response()->json(['token_invalid'], $exception->getStatusCode());
        
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException)
            return response()->json(['token_not_provided'], $exception->getStatusCode());

        return parent::render($request, $exception);
    }
}
