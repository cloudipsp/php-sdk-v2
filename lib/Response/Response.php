<?php

namespace Fondy\Response;

use Fondy\Configuration;
use Fondy\Exeption\ApiExeption;
use Fondy\Helper\ResponseHelper;
use Fondy\Helper\ResultHelper;

class Response
{
    /**
     * @var string
     */
    protected $requsetType;
    /**
     * @var array
     */
    protected $response;
    /**
     * @var string
     */
    protected $apiVersion;


    public function __construct($data)
    {
        $this->requestType = Configuration::getRequestType();
        $this->apiVersion = Configuration::getApiVersion();
        switch ($this->requestType) {
            case 'xml':
                $response = ResponseHelper::xmlToArray($data);
                break;
            case 'form':
                $response['response'] = ResponseHelper::formToArray($data);
                break;
            case 'json':
                $response = ResponseHelper::jsonToArray($data);
                break;
        }
        $this->checkResponse($response);

        $this->response = $response;

    }

    /**
     * Check response on errors
     * @param $response
     * @return mixed
     * @throws ApiExeption
     */
    private function checkResponse($response)
    {
        if (isset($response['response']['response_status']) && $response['response']['response_status'] == 'failure')
            throw new ApiExeption('Request is incorrect.', 200, $response);
        if (isset($response['response']['error_code']))
            throw new ApiExeption('Request is incorrect.', 200, $response);
        return $response;
    }

    /**
     * Redirect to checkout
     */
    public function toCheckout()
    {
        if ($this->response['checkout_url']) {
            header(sprintf('location: %s', $this->response['checkout_url']));
            exit;
        }
    }

    /**
     * @return bool|string
     */
    public function getUrl()
    {
        if (isset($this->response['response']['checkout_url'])) {
            return $this->response['response']['checkout_url'];
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        if ($this->apiVersion === '2.0') {
            return ResponseHelper::getBase64Data($this->response);
        } else {
            return $this->response['response'];
        }
    }

    protected function buildVerifyData()
    {
        if ($this->apiVersion === '2.0') {
            $data = ResponseHelper::getBase64Data($this->response);
            $data['encodedData'] = $this->response['response']['data'];
            $data['signature'] = $this->response['response']['signature'];
        } else {
            $data = $this->getData();
        }
        return $data;
    }

    /**
     * @return bool
     */
    public function isApproved()
    {
        $data = $this->buildVerifyData();
        return ResultHelper::isPaymentApproved($data, '', $this->apiVersion);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $data = $this->buildVerifyData();
        return ResultHelper::isPaymentValid($data, '', $this->apiVersion);
    }
}