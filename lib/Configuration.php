<?php

namespace Fondy;

use Fondy\Exeption;

class Configuration
{
    /**
     * @var int Mercahnt id
     */
    private static $MerchantID;
    /**
     * @var string Secret ket
     */
    private static $SecretKey;
    /**
     * @var string Credit Key
     */
    private static $CreditKey;
    /**
     * @var string Api version default 1.0
     */
    private static $ApiVersion = '1.0';
    /**
     * @var string Api endpoint url
     */
    private static $ApiUrl = 'api.fondy.eu';
    /**
     * @var string Api endpoint path
     */
    private static $ApiPath = '/api';
    /**
     * @var string request Client
     */
    private static $HttpClient = 'HttpCurl';

    /**
     * Define the Mercahnt id.
     *
     * @param int $MerchantID
     */
    public static function setMerchantId($MerchantID)
    {
        self::$MerchantID = $MerchantID;
    }

    /**
     * @return int
     */
    public static function getMerchantId()
    {
        return self::$MerchantID;
    }

    /**
     * Define the $SecretKey.
     *
     * @set string SecretKey
     */
    public static function setSecretKey($SecretKey)
    {
        self::$SecretKey = $SecretKey;
    }

    /**
     * @return string
     */
    public static function getSecretKey()
    {
        return self::$SecretKey;
    }

    /**
     * Define the $CreditKey.
     *
     * @set string CreditKey
     */
    public static function setCreditKey($CreditKey)
    {
        self::$CreditKey = $CreditKey;
    }

    /**
     * @return string
     */
    public static function getCreditKey()
    {
        return self::$CreditKey;
    }

    /**
     * @return string The API version used for requests. Default is v1.0
     */
    public static function getApiVersion()
    {
        return self::$ApiVersion;
    }

    /**
     * @set string ApiVersion The API version to use for requests.
     */
    public static function setApiVersion($ApiVersion)
    {
        self::$ApiVersion = $ApiVersion;
    }

    /**
     * @return string ApiUrl The API url to use for requests. Default is api.fondy.eu
     */
    public static function getApiUrl()
    {
        return 'https://' . self::$ApiUrl . self::$ApiPath;
    }

    /**
     * @set string ApiUrl The API url to use for requests.
     */
    public static function setApiUrl($ApiUrl)
    {
        self::$ApiUrl = $ApiUrl;
    }

    /**
     * @return mixed used Http Client
     */
    public static function getHttpClient()
    {
        $client = 'Fondy\\HttpClient\\' . self::$HttpClient;
        return new $client();
    }

    /**
     * @return mixed http Client
     */
    public static function setHttpClient($client)
    {
        $HttpClient = 'Fondy\\HttpClient\\' . $client;
        if (class_exists($HttpClient)) {
            self::$HttpClient = $client;
        } else {
            throw new Exeption\ApiExeption(
                "Client Class not found or name set up incorrectly. Available clients: HttpCurl, HttpGuzzle"
            );
        }
    }
}