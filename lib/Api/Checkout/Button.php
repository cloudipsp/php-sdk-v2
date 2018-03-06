<?php
namespace Fondy\Api\Checkout;

use Fondy\Api\Api;
use Fondy\Helper\ApiHelper;

class Button extends Api
{
    private $url = '/checkout';

    public function get($data)
    {
        $data = $this->prepareParams($data);
        $url = $this->createUrl($this->url);
        return ApiHelper::generateButtonUrl($data, $url);
    }
}