<?php

namespace Mukja\HackerRank;

use GuzzleHttp\Client as HttpClient;
use Mukja\HackerRank\MakesHttpRequests;
use Mukja\HackerRank\Exceptions\ApiKeyMissingException;

class HackerRank
{
    use MakesHttpRequests;

    const API_VERSION = 'v3';

    /**
     * The HackerRank API Key.
     *
     * @var string
     */
    public $apiKey;

    /**
     * The Guzzle HTTP Client instance.
     *
     * @var \GuzzleHttp\Client
     */
    public $guzzle;

    /**
     * Number of seconds a request is retried.
     *
     * @var int
     */
    public $timeout = 30;

    /**
     * HackerRank base uri.
     *
     * @var string
     */
    public $baseUri = 'https://www.hackerrank.com/x/api/v3/';

    /**
    *
    * @var Singleton
    */
    private static $instance;

    /**
     * Create a new Forge instance.
     *
     * @param  string $apiKey
     * @param  \GuzzleHttp\Client $guzzle
     * @return void
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->guzzle = new HttpClient([
            'base_uri' => $this->baseUri,
            'http_errors' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->apiKey
            ]
        ]);
    }

    /**
     * Transform the items of the collection to the given class.
     *
     * @param  array $collection
     * @param  string $class
     * @param  array $extraData
     * @return array
     */
    public function transformCollection($collection, $class, $extraData = [])
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData);
        }, $collection);
    }

    /**
     * Set the api key and setup the guzzle request object
     *
     * @param string $apiKey
     * @return $this
     */
    public static function setApiKey($apiKey)
    {
        if (is_null($apiKey)) {
            throw new ApiKeyMissingException();
        }

        self::$instance = new self($apiKey);

        return self::$instance;
    }

    /**
     * Set a new timeout
     *
     * @param  int $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get the timeout
     *
     * @return  int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function getVersion()
    {
        return self::API_VERSION;
    }
}
