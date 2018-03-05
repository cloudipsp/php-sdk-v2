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
    private $data;
    /**
     * @var string
     */
    private $apiVersion;

    /**
     * Response constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->requestType = Configuration::getRequestType();
        $this->apiVersion = Configuration::getApiVersion();
        
        switch ($this->requestType) {
            case 'xml':
                $data = ResponseHelper::xmlToArray($data);
                break;
            case 'form':
                $data = ResponseHelper::formToArray($data);
                break;
            case 'json':
                $data = ResponseHelper::jsonToArray($data);
                break;
        }
        if (isset($data['response']['response_status']) and $data['response']['response_status'] == 'failure')
            throw new ApiExeption('Request is incorrect.', 200, $data);
        $this->data = $data;

    }

    /**
     * Redirect to checkout
     */
    public function toCheckout()
    {
        header(sprintf('location: %s', $this->getData()['checkout_url']));
        exit;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        if ($this->apiVersion == '2.0') {
            return ResponseHelper::getBase64Data($this->data);
        } else {
            return $this->data['response'];
        }
    }
}