<?php

namespace Fondy\Helper;

class ValidationHelper
{
    /**
     * Validation required params not empty
     * @param $params
     * @param $required
     * @return bool
     */
    public static function validateRequiredParams($params, $required)
    {

        foreach ($required as $key => $param) {
            if (is_array($param))
                self::validateRequiredParams($params[$key], $param);
            if (!array_key_exists($key, $params)) {
                throw new \InvalidArgumentException(sprintf('Required param "%s" is missing', $key));
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
                case 'date':
                    self::validateDate($params[$key], $key);
                    break;
                case 'ccnumber':
                    self::validateCCard($params[$key]);
                    break;
                case 'ip':
                    self::validateIP($params[$key]);
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
    public static function validateURL($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException(sprintf("%s is not a fully qualified URL", $url));
        }
    }

    /**
     * Helper method for validating URLs
     * @param      $url
     * @param string|null $urlName
     * @throws \InvalidArgumentException
     */
    public static function validateDate($date, $format = null)
    {
        $check = explode("-", $date);
        if (!checkdate($check[1], $check[2], $check[0])) {
            throw new \InvalidArgumentException('Date is incorrect');
        }
    }

    /**
     * Helper method for validating Integer
     * @param      $url
     * @param string|null $urlName
     * @throws \InvalidArgumentException
     */
    public static function validateInteger($param, $key = '')
    {
        if (trim($param) != null && !is_numeric($param)) {
            throw new \InvalidArgumentException(sprintf('%s is not a valid numeric', $key));
        }
    }

    /**
     * Helper method for validating String
     * @param      $url
     * @param string|null $urlName
     * @throws \InvalidArgumentException
     */
    public static function validateString($param, $key = '')
    {
        if ($key !== 'order_id' && $param != null && !is_string($param)) {
            throw new \InvalidArgumentException(sprintf('%s is not a valid string', $key));
        }
        if ($key === 'order_id' && $param == null) {
            throw new \InvalidArgumentException(sprintf('%s is not a valid string', $key));
        }
    }

    /**
     * Luhn algorithm
     * @param $number
     * @return bool
     */
    protected static function validateCCard($number)
    {
        $checksum = 0;
        for ($i = (2 - (strlen($number) % 2)); $i <= strlen($number); $i += 2) {
            $checksum += (int)($number{$i - 1});
        }
        // Analyze odd digits in even length strings or even digits in odd length strings.
        for ($i = (strlen($number) % 2) + 1; $i < strlen($number); $i += 2) {
            $digit = (int)($number{$i - 1}) * 2;
            if ($digit < 10) {
                $checksum += $digit;
            } else {
                $checksum += ($digit - 9);
            }
        }
        if (($checksum % 10) == 0) {
            return true;
        } else {
            throw new \InvalidArgumentException(sprintf('\'%s\' is not a valid credit card number', $number));
        }
    }

    protected static function validateIP($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return true;
        } else {
            throw new \InvalidArgumentException(sprintf('\'%s\' is not a valid ip', $ip));
        }
    }
}