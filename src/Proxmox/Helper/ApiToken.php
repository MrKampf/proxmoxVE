<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Helper;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Proxmox\API;
use Proxmox\Exception\ProxmoxApiException;
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
     * @throws ProxmoxApiException|GuzzleException
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
            return $this->handleRequestException($exception, 'GET', $path);
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
     * @throws ProxmoxApiException|GuzzleException
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
            return $this->handleRequestException($exception, 'POST', $path);
        }
    }

    /**
     * Update new information in proxmox api over type put
     * @param string $path
     * @param array $params
     * @return array | null
     * @throws ProxmoxApiException|GuzzleException
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
            return $this->handleRequestException($exception, 'PUT', $path);
        }
    }

    /**
     * Delete new information in proxmox api over type delete
     * @param string $path
     * @param array $params
     * @return array | null
     * @throws ProxmoxApiException|GuzzleException
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
            return $this->handleRequestException($exception, 'DELETE', $path);
        }
    }

    /**
     * Centralised handling for a failed Guzzle request.
     *
     * Surfaces the failure through the configured PSR-3 logger (always, so
     * production sees the real Proxmox error instead of a silent null) and,
     * when the client was built with throwOnError, raises a
     * {@see ProxmoxApiException} carrying the HTTP status + response body.
     * Otherwise the library's historic behaviour is preserved: re-throw in
     * debug mode, swallow to null in normal operation.
     *
     * @param GuzzleException $exception
     * @param string $method
     * @param string $path
     * @return array|null
     * @throws ProxmoxApiException|GuzzleException
     */
    private function handleRequestException(GuzzleException $exception, string $method, string $path): ?array
    {
        $response = $exception instanceof RequestException ? $exception->getResponse() : null;
        $statusCode = $response?->getStatusCode();
        $body = $response !== null ? (string)$response->getBody() : null;

        $this->API->getLogger()?->error('Proxmox API ' . $method . ' ' . $path . ' failed: ' . $exception->getMessage(), [
            'method' => $method,
            'path' => $path,
            'status' => $statusCode,
            'body' => $body,
        ]);

        if ($this->API->getThrowOnError()) {
            throw new ProxmoxApiException($exception->getMessage(), $method, $path, $statusCode, $body, $exception);
        }

        if ($this->API->getDebug()) {
            throw $exception;
        }

        return null;
    }
}
