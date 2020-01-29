<?php

namespace App\Client;

use Symfony\Component\HttpClient\HttpClient;

abstract class AbstractClient
{
    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * AbstractClient constructor.
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->client = HttpClient::create();
    }

    /**
     * @param string $endpoint
     * @return array|null
     */
    public function get(string $endpoint)
    {
        $response = $this->client->request('GET', $this->baseUrl . $endpoint);

        try {
            $result = $response->toArray();
        } catch (\Exception $e) {
            $result = null;
        }

        return $result;
    }

    /**
     * @param string $endpoint
     * @param array $params
     * @return array|null
     */
    public function post(string $endpoint, array $params)
    {
        $response = $this->client->request('POST', $this->baseUrl . $endpoint, [
            'json' => $params
        ]);

        try {
            $result = $response->toArray();
        } catch (\Exception $e) {
            $result = null;
        }

        return $result;
    }
}