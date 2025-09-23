<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Helper;

use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\GuzzleException;
use Proxmox\PVE;
use Psr\Http\Message\ResponseInterface;

/**
 * Class api
 * @package proxmox\Helper
 */
use Proxmox\Helper\Interfaces\CookieJarFactoryInterface;

class ApiPVE
{
    /**
     * @var PVE
     */
    private PVE $pve;

    /**
     * @var CookieJarFactoryInterface
     */
    private CookieJarFactoryInterface $cookieJarFactory;

    /**
     * @var array|string[] $defaultHeaders
     */
    private array $defaultHeaders = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ];

    /**
     * Api constructor.
     * @param PVE $pve
     * @param CookieJarFactoryInterface|null $cookieJarFactory
     */
    public function __construct(PVE $pve, CookieJarFactoryInterface $cookieJarFactory = null)
    {
        $this->pve = $pve;
        $this->cookieJarFactory = $cookieJarFactory ?? new CookieJarFactory();
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
            return $this->getBody($this->pve->getHttpClient()->request('GET', $this->pve->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->pve->isDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => array_merge($this->defaultHeaders, [
                    'CSRFPreventionToken' => $this->pve->getCsrfPreventionToken()
                ]),
                'query' => $params,
                'exceptions' => false,
                'cookies' => $this->pve->getCookie(),
            ]));
        } catch (GuzzleException $exception) {
            if ($this->pve->isDebug()) {
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
            return $this->getBody($this->pve->getHttpClient()->request('POST', $this->pve->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->pve->isDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => array_merge($this->defaultHeaders, [
                    'CSRFPreventionToken' => $this->pve->getCsrfPreventionToken(),
                    'Content-Type' => (count($params) > 0) ? 'application/json' : null,
                ]),
                'exceptions' => false,
                'cookies' => $this->pve->getCookie(),
                'json' => (count($params) > 0) ? $params : null,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->pve->isDebug()) {
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
            return $this->getBody($this->pve->getHttpClient()->request('PUT', $this->pve->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->pve->isDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => array_merge($this->defaultHeaders, [
                    'CSRFPreventionToken' => $this->pve->getCsrfPreventionToken(),
                    'Content-Type' => (count($params) > 0) ? 'application/json' : null,
                ]),
                'exceptions' => false,
                'cookies' => $this->pve->getCookie(),
                'json' => (count($params) > 0) ? $params : null,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->pve->isDebug()) {
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
            return $this->getBody($this->pve->getHttpClient()->request('DELETE', $this->pve->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->pve->isDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => array_merge($this->defaultHeaders, [
                    'CSRFPreventionToken' => $this->pve->getCsrfPreventionToken(),
                    'Content-Type' => (count($params) > 0) ? 'application/json' : null,
                ]),
                'exceptions' => false,
                'cookies' => $this->pve->getCookie(),
                'query' => (count($params) > 0) ? $params : null,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->pve->isDebug()) {
                print_r($exception->getMessage());
            }
            return null;
        }
    }

    /**
     * Login to proxmox ve
     */
    public function login()
    {
        $requestResult = $this->getCsrfToken();
        $this->pve->setCsrfPreventionToken($requestResult['CSRFPreventionToken']);
        $this->pve->setTicket($requestResult['ticket']);
        $this->pve->setCookie($this->getCookies());
    }

    /**
     * Get CSRF token data from proxmox api for api auth
     * @return array | null
     */
    public function getCsrfToken(): ?array
    {
        try {
            return $this->getBody($this->pve->getHttpClient()->request('POST', $this->pve->getApiURL() . 'access/ticket', [
                'verify' => false,
                'debug' => $this->pve->isDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => $this->defaultHeaders,
                'json' => [
                    'username' => $this->pve->getUsername(),
                    'password' => $this->pve->getPassword(),
                    'realm' => $this->pve->getAuthType(),
                ],
            ]))['data'];
        } catch (GuzzleException $exception) {
            if ($this->pve->isDebug()) {
                print_r($exception->getMessage());
            }
            return null;
        }
    }

    /**
     * Get cookies for auth
     * @return CookieJar
     */
    public function getCookies(): CookieJar
    {
        return $this->cookieJarFactory->create([
            'PVEAuthCookie' => $this->pve->getTicket(),
        ], $this->pve->getHostname());
    }

}
