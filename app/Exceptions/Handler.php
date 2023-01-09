<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Queue\MaxAttemptsExceededException;
use Illuminate\Support\Facades\Log;

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
        $this->reportable(function (QueryException $e) {
            Log::critical('No DB Connection or similar error'  . $e);
        });
        $this->reportable(function (QueryException $e) {
            Log::critical('No DB Connection or similar error ' . $e);
        });
        $this->reportable(function (RelationNotFoundException $e) {
            Log::critical('Relation not found error'  . $e);
        });
        $this->reportable(function (\HttpRuntimeException $e) {
            Log::critical('Runtime Exception' . $e);
        });
        $this->reportable(function (MaxAttemptsExceededException $e) {
            Log::critical('Quere max attempts error' . $e);
        });
        $this->reportable(function (\PDOException $e) {
            Log::critical('No DB Connection or similar error' . $e);
        });
    }
}
