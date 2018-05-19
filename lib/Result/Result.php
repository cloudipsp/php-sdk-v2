<?php

namespace Fondy\Result;


class Result
{
    /**
     * @var array
     */
    protected $result;

    public function __construct($data)
    {
        $this->result = $data;
    }
}