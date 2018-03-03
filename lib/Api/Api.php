<?php

namespace Fondy\Api;

use Fondy\Fondy;
use Fondy\Configuration;
use Fondy\Exeption\ApiExeption;

class Api extends Fondy
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param $data
     * @throws ApiExeption
     */
    public function request($data)
    {
        $version = Configuration::getApiVersion();
        if(!$version)
            throw new ApiExeption('Unknown api version');

    }
}