<?php

namespace Fondy\Api\Checkout;

use Fondy\Api\Api;
use Fondy\Helper\ApiHelper;

class Url extends Api
{
    private $url = '/checkout/url/';

    public function get($data, $headers = [''])
    {
        $data = $this->prepareParams($data);
        return parent::Request($method = 'POST', $this->url, $headers, $data);
    }

    /**
     * @param $params
     * @return string
     */
    private function prepareParams($params)
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
        if (!isset($prepared_params['signature'])) {
            $prepared_params['signature'] = ApiHelper::generateSignature($prepared_params, $this->secret_key, $this->version);
        }

        return json_encode(['request' => $prepared_params]);
    }
}