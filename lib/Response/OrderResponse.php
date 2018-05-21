<?php

namespace Fondy\Response;

use Fondy\Exeption\ApiExeption;

class OrderResponse extends Response
{
    /**
     * @return bool
     */
    public function isReversed()
    {
        $data = $this->getData();
        if (!isset($data['reverse_status']))
            return 'Nothing to check';
        $valid = $this->isValid();
        if ($valid && $data['reverse_status'] === 'approved')
            return true;

        return false;
    }

    /**
     * @return bool|string
     * @throws \Exception
     */
    public function isCaptured()
    {
        $data = $this->getData();
        if (!isset($data['capture_status']))
            return 'Nothing to check';
        $valid = $this->isValid();
        if ($valid && $data['capture_status'] === 'captured')
            return true;

        return false;
    }

    /**
     * Cheking if Captured transaction
     * @return bool
     * @throws \Exception
     */
    public function isCapturedByList()
    {
        $data = $this->getCapturedTransAction();

        if (!array_key_exists('capture_status', $data)) throw new \Exception('invalid response');
        return $data['capture_status'] != 'captured' ? false : true;
    }

    private function getCapturedTransAction()
    {
        foreach ($this->getData() as $data) {
            if (($data['tran_type'] == 'purchase' || $data['tran_type'] == 'verification')
                && $data['preauth'] == 'Y'
                && $data['transaction_status'] == 'approved'
            ) {
                return $data;
            } else {
                throw new ApiExeption('Nothing to capture');
            }
        }
    }
}