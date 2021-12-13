<?php

namespace Computan\App\Exception;

use Exception;
use Throwable;
use Computan\App\Models\Debbuger;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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
           
        });
    }
    public function report(Throwable $e) {

        $exception = [
            "name" => get_class($e),
            "message" => $e->getMessage(),
            "file" => $e->getFile(),
            "line" => $e->getLine(),
            "type" => 'exception',
        ];
        Debbuger::create($exception);
        parent::report($e);
        parent::report($e);
    }
}
