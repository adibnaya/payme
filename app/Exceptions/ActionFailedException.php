<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ActionFailedException extends Exception
{

    protected $message;

    /**
     * ActionFailedException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = $message;
    }
}
