<?php

namespace Fondy\Response;

use Fondy\Configuration;
use Fondy\Exeption\ApiExeption;
use Fondy\Helper\ResponseHelper;
class Response
{
    private $requsetType;
    /**
     * @var array
     */
    private $data;

    /**
     * Response constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->requestType = Configuration::getRequestType();
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
        $this->data = $data;
        if ($data['response']['response_status'] == 'failure')
            throw new ApiExeption('Request is incorrect.', 200, $data);
    }

    /**
     * @param $data
     */
    public function toCheckout()
    {
        header(sprintf('location: %s', $this->data['response']['checkout_url']));
        exit;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data['response'];
    }
}