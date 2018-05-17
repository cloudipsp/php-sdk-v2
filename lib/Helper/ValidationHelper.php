<?php

namespace Fondy\Helper;

class ValidationHelper
{
    /**
     * Validation required params not empty
     * @param $params
     * @param $required
     */
    public static function validateRequiredParams($params, $required)
    {


        foreach ($required as $key => $param) {
            if (!array_key_exists($key, $params)) {
                throw new \InvalidArgumentException('Some required param\s is missing');
            }
            if (array_key_exists($key, $required) && empty($param)) {
                throw new \InvalidArgumentException(sprintf('Required param "%s" is empty', $key));
            }
            switch ($param) {
                case 'integer':
                    self::validateInteger($params[$key], $key);
                    break;
                case 'string':
                    self::validateString($params[$key], $key);
                    break;
            }

        }

        return true;
    }

    /**
     * Helper method for validating URLs
     * @param      $url
     * @param string|null $urlName
     * @throws \InvalidArgumentException
     */
    public static function validateURL($url, $urlName = null)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException("$urlName is not a fully qualified URL");
        }
    }

    public static function validateInteger($param, $key = '')
    {
        if (trim($param) != null && !is_numeric($param)) {
            throw new \InvalidArgumentException('%s is not a valid numeric', $key);
        }
    }

    public static function validateString($param, $key = '')
    {
        if ($param != null && !is_string($param)) {
            throw new \InvalidArgumentException(sprintf('%s is not a valid string', $key));
        }
    }
}