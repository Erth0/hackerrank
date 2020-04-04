<?php

namespace Mukja\HackerRank\Exceptions;

use Exception;

class ApiKeyMissingException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('HackerRank api key is missing, Make sure you have attached api key.');
    }
}
