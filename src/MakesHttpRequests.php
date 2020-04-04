<?php

namespace Mukja\HackerRank;

use Mukja\HackerRank\Exceptions\FailedActionException;
use Mukja\HackerRank\Exceptions\NotFoundException;
use Mukja\HackerRank\Exceptions\PermissionException;
use Mukja\HackerRank\Exceptions\TimeoutException;
use Mukja\HackerRank\Exceptions\ValidationException;
use Psr\Http\Message\ResponseInterface;

trait MakesHttpRequests
{
    /**
     * Make a GET request to HackerRank servers and return the response.
     *
     * @param  string $uri
     * @return mixed
     */
    public function get($uri)
    {
        return $this->request('GET', $uri);
    }

    /**
     * Make a POST request to HackerRank servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    public function post($uri, array $payload = [])
    {
        return $this->request('POST', $uri, $payload);
    }

    /**
     * Make a PUT request to HackerRank servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    public function put($uri, array $payload = [])
    {
        return $this->request('PUT', $uri, $payload);
    }

    /**
     * Make a DELETE request to HackerRank servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    public function delete($uri, array $payload = [])
    {
        return $this->request('DELETE', $uri, $payload);
    }

    /**
     * Make request to HackerRank servers and return the response.
     *
     * @param  string $verb
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    public function request($verb, $uri, array $payload = [])
    {
        $response = $this->guzzle->request($verb, $uri,
            empty($payload) ? [] : ['form_params' => $payload]
        );

        if ($response->getStatusCode() != 200) {
            // Check for 204 response
            if ($response->getStatusCode() == 204 && $verb === 'DELETE') {
                return true;
            }

            return $this->handleRequestError($response);
        }

        $responseBody = (string) $response->getBody();

        return json_decode($responseBody, true) ?: $responseBody;
    }

    /**
     * @param  \Psr\Http\Message\ResponseInterface $response
     * @return void
     */
    public function handleRequestError(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 422) {
            throw new ValidationException(json_decode((string) $response->getBody(), true));
        }

        if ($response->getStatusCode() == 404) {
            throw new NotFoundException();
        }

        if ($response->getStatusCode() == 400) {
            throw new FailedActionException((string) $response->getBody());
        }

        if ($response->getStatusCode() == 403) {
            $responseBody = json_decode((string) $response->getBody(), true);

            throw new PermissionException(
                $responseBody['errors'][0]
            );
        }

        throw new \Exception((string) $response->getBody());
    }

    /**
     * Retry the callback or fail after x seconds.
     *
     * @param  integer $timeout
     * @param  callable $callback
     * @return mixed
     */
    public function retry($timeout, $callback)
    {
        $start = time();

        beginning:

        if ($output = $callback()) {
            return $output;
        }

        if (time() - $start < $timeout) {
            sleep(5);

            goto beginning;
        }

        throw new TimeoutException($output);
    }
}
