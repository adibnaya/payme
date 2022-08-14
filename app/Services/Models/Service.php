<?php

namespace App\Services\Models;

use App\Exceptions\ActionFailedException;
use DB;
use Exception;
use Log;

class Service
{

    /**
     * @param Exception $exception
     * @param $message
     * @param bool $withLog
     * @throws Exception
     * @throws ActionFailedException
     */
    protected function handleException(Exception $exception, $message = null, bool $withLog = true): void
    {
        DB::rollBack();

        if ($withLog) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());
        }

        throw new ActionFailedException($message ?: $exception->getMessage(), 500, $exception);
    }

}
