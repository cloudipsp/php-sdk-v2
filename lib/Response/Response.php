<?php

namespace Fondy\Response;


class Response
{
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
        $this->data = $data;
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