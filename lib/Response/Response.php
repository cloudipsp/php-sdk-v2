<?php

namespace Fondy\Response;

use Fondy\Configuration;
use Fondy\Exeption\ApiExeption;
use Fondy\Helper\ResponseHelper;

class Response
{
    /**
     * @var string
     */
    private $requsetType;
    /**
     * @var array
     */
    private $response;
    /**
     * @var string
     */
    private $apiVersion;


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
     * @return bool
     */
    public function isReversed()
    {
        if (isset($this->response['response']['reverse_status']) && $this->response['response']['reverse_status'] === 'approved') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function isCaptured()
    {
        if (isset($this->response['response']['capture_status']) && $this->response['response']['capture_status'] === 'captured') {
            return true;
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
}