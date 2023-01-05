<?php

namespace App\Logging;

use App\Models\Log;
use Monolog\Handler\AbstractProcessingHandler;

class LogToDatabaseHandler extends AbstractProcessingHandler
{

    protected function write(array $record): void
    {
        $log = new Log();
        $log->log_message = $record['message'];
        $log->log_component = $record['channel'];
        $log->log_level = $record['level_name'];
        $log->user_id = $record['context']['user'];
        $log->save();
    }
}
