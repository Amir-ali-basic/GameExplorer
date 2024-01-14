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

    public static function getErrorMessage($statusCode, $exceptionMessage = '')
    {
        switch ($statusCode) {
            case 200:
                return null;
            case 400:
                return 'Bad request. Please check your request parameters.';
            case 401:
                return 'Unauthorized. Please check your credentials.';
            case 403:
                return 'Forbidden. You do not have permission to access this resource.';
            case 404:
                return 'Not found. The requested resource could not be found.';
            case 500:
                return 'Internal Server Error. Please try again later.';
            default:
                return $exceptionMessage ? "Error: $exceptionMessage" : "API Error with status code: $statusCode";
        }
    }
}
