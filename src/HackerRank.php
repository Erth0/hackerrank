<?php

namespace Mukja\HackerRank;

use GuzzleHttp\Client as HttpClient;
use Mukja\HackerRank\MakesHttpRequests;
use Mukja\HackerRank\Actions\ManageTests;
use Mukja\HackerRank\Actions\ManageUsers;
use Mukja\HackerRank\Actions\ManageTestCandidates;

class HackerRank
{
    use MakesHttpRequests,
        ManageUsers,
        ManageTests,
        ManageTestCandidates;

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
     * Create a new Forge instance.
     *
     * @param  string $apiKey
     * @param  \GuzzleHttp\Client $guzzle
     * @return void
     */
    public function __construct($apiKey = null, HttpClient $guzzle = null)
    {
        if (! is_null($apiKey)) {
            $this->setApiKey($apiKey, $guzzle);
        }

        if (! is_null($guzzle)) {
            $this->guzzle = $guzzle;
        }
    }

    /**
     * Transform the items of the collection to the given class.
     *
     * @param  array $collection
     * @param  string $class
     * @param  array $extraData
     * @return array
     */
    protected function transformCollection($collection, $class, $extraData = [])
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this);
        }, $collection);
    }

    /**
     * Set the api key and setup the guzzle request object
     *
     * @param string $apiKey
     * @return $this
     */
    public function setApiKey($apiKey, $guzzle)
    {
        $this->apiKey = $apiKey;
        $this->guzzle = $guzzle ?: new HttpClient([
            'base_uri' => 'https://www.hackerrank.com/x/api/v3/',
            'http_errors' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->apiKey
            ]
        ]);

        return $this;
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
}
