<?php
namespace Fondy\Exeption;
use Exception;

abstract class MainExeption extends Exception
{
    public function __construct(
        $message,
        $httpStatus = null,
        $json = null
    ) {
        $this->httpStatus = $httpStatus;
        $this->json = $json;
        $this->fondyCode = isset($json["error"]["code"]) ? $message = $json["error"]["code"] . "\n" . $message : null;
        $this->requestId = isset($json["error"]["request_id"]) ? $message = $json["error"]["request_id"] . "\n" . $message : null;
        parent::__construct($message);
    }
    public function getfondyCode()
    {
        return $this->fondyCode;
    }
    public function getHttpBody()
    {
        return $this->httpBody;
    }
    public function getJsonBody()
    {
        return $this->json;
    }
    public function getRequestId()
    {
        return $this->requestId;
    }
}