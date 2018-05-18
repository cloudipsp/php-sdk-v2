<?php

namespace Fondy\Api\Checkout;

use Fondy\Api\Api;
use Fondy\Helper\ApiHelper;

class Button extends Api
{
    private $url = '/checkout';
    /**
     * Minimal required params to get checkout
     * @var array
     */
    private $requiredParams = [
        'merchant_id' => 'integer',
        'order_desc' => 'string',
        'amount' => 'integer',
        'currency' => 'string'
    ];

    /**
     * @param $data
     * @return string
     *
     */
    public function get($data)
    {
        $requestData = $this->prepareButtonParams($data);
        $url = $this->createUrl($this->url);
        $this->validate($requestData, $this->requiredParams);
        return ApiHelper::generateButtonUrl($requestData, $url);
    }

    /**
     * @param $params
     * @return mixed
     */
    protected function prepareButtonParams($params)
    {
        $prepared_params = $params;

        if (!isset($prepared_params['merchant_id'])) {
            $prepared_params['merchant_id'] = $this->mid;
        }
        if (!isset($prepared_params['order_id'])) {
            $prepared_params['order_id'] = ApiHelper::generateOrderID($this->mid);
        }
        if (!isset($prepared_params['order_desc'])) {
            $prepared_params['order_desc'] = ApiHelper::generateOrderDesc($prepared_params['order_id']);
        }
        if (isset($prepared_params['merchant_data']['fields'])) {
            $prepared_params['fields'] = $prepared_params['merchant_data']['fields'];

        }
        unset($prepared_params['merchant_data']);
        return $prepared_params;
    }
}