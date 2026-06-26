<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Helper;

use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Proxmox\Exception\ProxmoxApiException;
use Proxmox\PVE;
use Psr\Http\Message\ResponseInterface;

/**
 * Class api
 * @package proxmox\Helper
 */
class ApiPVE
{
    /**
     * @var PVE
     */
    private PVE $PVE;

    /**
     * @var array|string[] $defaultHeaders
     */
    private array $defaultHeaders = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ];

    /**
     * Api constructor.
     * @param PVE $PVE
     */
    public function __construct(PVE $PVE)
    {
        $this->PVE = $PVE;
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
            return $this->getBody($this->PVE->getHttpClient()->request('GET', $this->PVE->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->PVE->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => array_merge($this->defaultHeaders, [
                    'CSRFPreventionToken' => $this->PVE->getCSRFPreventionToken()
                ]),
                'query' => $params,
                'exceptions' => false,
                'cookies' => $this->PVE->getCookie(),
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
            return $this->getBody($this->PVE->getHttpClient()->request('POST', $this->PVE->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->PVE->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => array_merge($this->defaultHeaders, [
                    'CSRFPreventionToken' => $this->PVE->getCSRFPreventionToken(),
                    'Content-Type' => (count($params) > 0) ? 'application/json' : null,
                ]),
                'exceptions' => false,
                'cookies' => $this->PVE->getCookie(),
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
            return $this->getBody($this->PVE->getHttpClient()->request('PUT', $this->PVE->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->PVE->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => array_merge($this->defaultHeaders, [
                    'CSRFPreventionToken' => $this->PVE->getCSRFPreventionToken(),
                    'Content-Type' => (count($params) > 0) ? 'application/json' : null,
                ]),
                'exceptions' => false,
                'cookies' => $this->PVE->getCookie(),
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
            return $this->getBody($this->PVE->getHttpClient()->request('DELETE', $this->PVE->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->PVE->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => array_merge($this->defaultHeaders, [
                    'CSRFPreventionToken' => $this->PVE->getCSRFPreventionToken(),
                    'Content-Type' => (count($params) > 0) ? 'application/json' : null,
                ]),
                'exceptions' => false,
                'cookies' => $this->PVE->getCookie(),
                'query' => (count($params) > 0) ? $params : null,
            ]));
        } catch (GuzzleException $exception) {
            return $this->handleRequestException($exception, 'DELETE', $path);
        }
    }

    /**
     * Login to proxmox ve
     */
    public function login()
    {
        $requestResult = $this->getCSRFToken();
        $this->PVE->setCSRFPreventionToken($requestResult['CSRFPreventionToken']);
        $this->PVE->setTicket($requestResult['ticket']);
        $this->PVE->setCookie($this->getCookies());
    }

    /**
     * Get CSRF token data from proxmox api for api auth
     * @return array | null
     * @throws ProxmoxApiException|GuzzleException
     */
    public function getCSRFToken(): ?array
    {
        try {
            return $this->getBody($this->PVE->getHttpClient()->request('POST', $this->PVE->getApiURL() . 'access/ticket', [
                'verify' => false,
                'debug' => $this->PVE->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => $this->defaultHeaders,
                'json' => [
                    'username' => $this->PVE->getUsername(),
                    'password' => $this->PVE->getPassword(),
                    'realm' => $this->PVE->getAuthType(),
                ],
            ]))['data'];
        } catch (GuzzleException $exception) {
            return $this->handleRequestException($exception, 'POST', 'access/ticket');
        }
    }

    /**
     * Get cookies for auth
     * @return CookieJar
     */
    public function getCookies(): CookieJar
    {
        return CookieJar::fromArray([
            'PVEAuthCookie' => $this->PVE->getTicket(),
        ], $this->PVE->getHostname());
    }

    /**
     * Centralised handling for a failed Guzzle request.
     *
     * Surfaces the failure through the configured PSR-3 logger (always, so
     * production sees the real Proxmox error instead of a silent null) and,
     * when the client was built with throwOnError, raises a
     * {@see ProxmoxApiException} carrying the HTTP status + response body.
     * Otherwise the library's historic behaviour is preserved: print the
     * message in debug mode, swallow to null in normal operation.
     *
     * @param GuzzleException $exception
     * @param string $method
     * @param string $path
     * @return array|null
     * @throws ProxmoxApiException
     */
    private function handleRequestException(GuzzleException $exception, string $method, string $path): ?array
    {
        $response = $exception instanceof RequestException ? $exception->getResponse() : null;
        $statusCode = $response?->getStatusCode();
        $body = $response !== null ? (string)$response->getBody() : null;

        $this->PVE->getLogger()?->error('Proxmox API ' . $method . ' ' . $path . ' failed: ' . $exception->getMessage(), [
            'method' => $method,
            'path' => $path,
            'status' => $statusCode,
            'body' => $body,
        ]);

        if ($this->PVE->getThrowOnError()) {
            throw new ProxmoxApiException($exception->getMessage(), $method, $path, $statusCode, $body, $exception);
        }

        if ($this->PVE->getDebug()) {
            print_r($exception->getMessage());
        }

        return null;
    }
}
