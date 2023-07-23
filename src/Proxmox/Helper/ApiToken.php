<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Helper;

use GuzzleHttp\Exception\GuzzleException;
use Proxmox\API;
use Psr\Http\Message\ResponseInterface;

/**
 * Class api
 * @package proxmox\Helper
 */
class ApiToken
{
    /**
     * @var API
     */
    private API $API;

    /**
     * @var array|string[] $defaultHeaders
     */
    private array $defaultHeaders = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ];

    /**
     * Api constructor.
     * @param API $API
     */
    public function __construct(API $API)
    {
        $this->API = $API;
    }

    /**
     * Request information from proxmox api over type get
     * @param string $path
     * @param array $params
     * @return array | null
     */
    public function get(string $path, array $params = []): ?array
    {
        try {
            return $this->getBody($this->API->getHttpClient()->request('GET', $this->API->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->API->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => array_merge($this->defaultHeaders, [
                    'Authorization' => 'PVEAPIToken=' . $this->API->getUser() . '=' . $this->API->getSecret(),
                ]),
                'query' => $params,
                'exceptions' => false,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->API->getDebug()) {
                print_r($exception->getMessage());
            }
            return null;
        }
    }

    /**
     * Get response information as array
     * @param ResponseInterface $response
     * @return array|null
     */
    public function getBody(ResponseInterface $response): ?array
    {
        return json_decode($response->getBody(), true);
    }

    /**
     * Store new information in proxmox api over type post
     * @param string $path
     * @param array $params
     * @return array | null
     */
    public function post(string $path, array $params = []): ?array
    {
        try {
            return $this->getBody($this->API->getHttpClient()->request('POST', $this->API->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->API->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => array_merge($this->defaultHeaders, [
                    'Authorization' => 'PVEAPIToken=' . $this->API->getUser() . '=' . $this->API->getSecret(),
                    'Content-Type' => (count($params) > 0) ? 'application/json' : null,
                ]),
                'exceptions' => false,
                'json' => (count($params) > 0) ? $params : null,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->API->getDebug()) {
                print_r($exception->getMessage());
            }
            return null;
        }
    }

    /**
     * Update new information in proxmox api over type put
     * @param string $path
     * @param array $params
     * @return array | null
     */
    public function put(string $path, array $params = []): ?array
    {
        try {
            return $this->getBody($this->API->getHttpClient()->request('PUT', $this->API->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->API->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => array_merge($this->defaultHeaders, [
                    'Authorization' => 'PVEAPIToken=' . $this->API->getUser() . '=' . $this->API->getSecret(),
                    'Content-Type' => (count($params) > 0) ? 'application/json' : null,
                ]),
                'exceptions' => false,
                'json' => (count($params) > 0) ? $params : null,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->API->getDebug()) {
                print_r($exception->getMessage());
            }
            return null;
        }
    }

    /**
     * Delete new information in proxmox api over type delete
     * @param string $path
     * @param array $params
     * @return array | null
     */
    public function delete(string $path, array $params = []): ?array
    {
        try {
            return $this->getBody($this->API->getHttpClient()->request('DELETE', $this->API->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->API->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => array_merge($this->defaultHeaders, [
                    'Authorization' => 'PVEAPIToken=' . $this->API->getUser() . '=' . $this->API->getSecret(),
                    'Content-Type' => (count($params) > 0) ? 'application/json' : null,
                ]),
                'exceptions' => false,
                'query' => (count($params) > 0) ? $params : null,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->API->getDebug()) {
                print_r($exception->getMessage());
            }
            return null;
        }
    }

}
