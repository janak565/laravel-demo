<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Auth;

use Throwable;
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
        
        //print_r(Auth::user()->role);
        $this->reportable(function (Throwable $e) {
        });
        $this->renderable(function (Throwable $exception) {
         
            if ($exception instanceof NotFoundHttpException) {
                if(auth()->check()){
                    if (auth()->user()->role == 'superadmin') {
                    return redirect(url('superadmin/home'));
                    }else if (auth()->user()->role == 'admin') {
                        return redirect(url('admin/home'));
                    }else if (auth()->user()->role == 'user'){
                        return redirect(url('user/home'));
                    }
                }else{
                    return redirect(url('login'));
                }
           }
        });
    }
}
