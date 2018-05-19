<?php

namespace Fondy\Response;

use Fondy\Helper\ResultHelper;

class PaymentResponse extends Response
{
    /**
     * @return bool
     */
    public function isApproved()
    {
        if (isset($this->response['response']['order_status']) && $this->response['response']['order_status'] === 'approved') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return ResultHelper::isPaymentValid($this->getData());
    }
}