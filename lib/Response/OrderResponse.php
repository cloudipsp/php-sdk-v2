<?php

namespace Fondy\Response;

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
     * @return bool
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
}