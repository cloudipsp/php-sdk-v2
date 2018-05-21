<?php

namespace Fondy\Result;

use Fondy\Helper\ResponseHelper;
use Fondy\Helper\ResultHelper;
use Fondy\Configuration;

class Result
{
    /**
     * @var array
     */
    protected $result;
    /**
     * @var array
     */
    protected $requestType;
    /**
     * @var array
     */
    protected $secretKey;
    /**
     * @var array
     */
    protected $apiVersion;

    public function __construct(array $data = [], $key = '', $type = '', $formatted = true)
    {
        $this->apiVersion = Configuration::getApiVersion();
        if (!$type) {
            $this->requestType = Configuration::getRequestType();
        } else {
            $this->requestType = $type;
        }
        if (!$data) {
            $this->result = $this->parseResult($formatted);
        } else {
            $this->result = $data;
        }
        if (!$key) {
            $this->secretKey = Configuration::getSecretKey();
        } else {
            $this->secretKey = $key;
        }
    }

    /**
     * @param $formatted
     * @return array
     */
    private function parseResult($formatted)
    {
        $result = $_POST;
        if (empty($result))
            $result = file_get_contents('php://input');
        if ($formatted) {
            switch ($this->requestType) {
                case 'xml':
                    $result = ResponseHelper::xmlToArray($result, true, true, 'UTF-8');
                    break;
                case 'json':
                    $result = ResponseHelper::jsonToArray($result);
                    break;
            }
        }
        return $result;

    }

    public function getData()
    {
        if ($this->apiVersion === '2.0') {
            $result = ResponseHelper::getBase64Data(['response' => $this->result]);
            $result['encodedData'] = $this->result['data'];
            $result['signature'] = $this->result['signature'];
            return $result;
        } else {
            return $this->result;
        }
    }

    /**
     * @return bool
     */
    public function isApproved()
    {
        $data = $this->getData();
        return ResultHelper::isPaymentApproved($data, $this->secretKey, $this->apiVersion);
    }

    /**
     * @return bool
     */
    public function getToken()
    {
        $data = $this->getData();
        return $data['rectoken'] ? $data['rectoken'] : false;
    }

    /**
     * @return bool
     */
    public function getParam($param)
    {
        $data = $this->getData();
        return $data[$param] ? $data[$param] : false;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $data = $this->getData();
        return ResultHelper::isPaymentValid($data, $this->secretKey, $this->apiVersion);
    }

    /**
     * @return bool
     */
    public function isProcessing()
    {
        $data = $this->getData();
        if (!isset($data['order_status']))
            return 'Nothing to check';
        $valid = $this->isValid();
        if ($valid && $data['order_status'] === 'processing')
            return true;

        return false;

    }

    /**
     * @return bool
     */
    public function isDeclined()
    {
        $data = $this->getData();
        if (!isset($data['order_status']))
            return 'Nothing to check';
        $valid = $this->isValid();
        if ($valid && $data['order_status'] === 'declined')
            return true;

        return false;

    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        $data = $this->getData();
        if (!isset($data['order_status']))
            return 'Nothing to check';
        $valid = $this->isValid();
        if ($valid && $data['order_status'] === 'expired')
            return true;

        return false;

    }
}