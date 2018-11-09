<?php

namespace Cloudipsp\Response;

use Cloudipsp\Helper;
use Cloudipsp\Exception\ApiException;
use Cloudipsp\Configuration;

class PcidssResponse extends Response
{
    /**
     * @return bool
     */
    public function is3ds()
    {
        if (array_key_exists('acs_url', $this->response['response'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get form page for 3ds step 2
     * @param string $response_url
     * @return mixed
     * @throws ApiException
     */
    public function get3dsFormContent($response_url = '')
    {
        $data = $this->getData();

        if (!isset($data['md'])) {
            throw new ApiException('Required param MD is missing or empty.');
        }
        Helper\ValidationHelper::validateURL($data['acs_url']);
        $formData = [
            'PaReq' => $data['pareq'],
            'MD' => $data['md'],
            'TermUrl' => $response_url ? $response_url : ''
        ];
        $client = Configuration::getHttpClient();
        $form3dsContent = $client->request('POST', $data['acs_url'], ['Content-Type: multipart/form-data'], $formData);
        return $form3dsContent;
    }
}