<?php

namespace Datakraf\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use \InvalidArgumentException;
use Spatie\Permission\Models\Role;
use Alert;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

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
        if ($exception instanceof AuthorizationException) {
            return $this->unauthorized($request, $exception);
        }
        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }
        if ($exception instanceof InvalidSignatureException) {
            return $this->invalidUrlSignature($request, $exception);
        }
        if ($exception instanceof TokenMismatchException) {
            return $this->pageExpired($request, $exception);
        }

         //mobile
         if($request->expectsJson()){
            if($exception instanceof ValidationException){
                return response()->json([
                    'message'=>$exception->getMessage(),
                    'errors'=> $exception->validator->errors()
                ],422);
            }
        }
        return parent::render($request, $exception);
    }

    public function noRole($request, Exception $exception)
    {
        if (!Auth::user()->hasAnyRole(Role::all())) {
            toast('You have no role in this system', 'error', 'top');
            Auth::logout();
        }
    }

    private function unauthorized($request, Exception $exception)
    {
        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest('/');
        toast('You don\'t have the previlege to perform the action', 'error', 'top');
        return redirect()->back();
    }

    public function invalidUrlSignature($request, Exception $exception)
    {
        // toast('Security token mismatched. You\'re not allowed to perform the operation', 'error', 'top');
        return redirect()->back();
    }

    public function pageExpired($request, Exception $exception)
    {
        toast('Your session has expired, please login again', 'error', 'top');
        return redirect('/');
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $guard = array_get($exception->guards(), 0);
        switch ($guard) {
            case 'staff':
                $login = 'staff.login';
                break;
            default:
                $login = 'login';
                break;
        }
        return redirect()->guest(route($login));
    }
}
