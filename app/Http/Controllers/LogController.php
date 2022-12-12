<?php

namespace App\Http\Controllers;

use App\Logging\LogToDatabaseHandler;
use Monolog\Logger;

class LogController extends Controller
{
    /**
     * 10     * Create a custom Monolog instance.
     * 11     *
     * 12     * @return Logger
     * 13     */
    public function __invoke(array $config)
    {
        return new Logger('Database', [
            new LogToDatabaseHandler(),
        ]);
    }
}
