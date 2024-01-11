<?php
namespace App\Exception;

class ApiException extends \Exception
{
    protected $statusCode;

    public function __construct($message = "", $statusCode = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $statusCode, $previous);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
