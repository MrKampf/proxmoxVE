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
class Api
{
    /**
     * @var PVE
     */
    private PVE $PVE;

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
     */
    public function get(string $path, array $params = []): ?array
    {
        try {
            return $this->getBody($this->PVE->getHttpClient()->request('GET', $this->PVE->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->PVE->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => [
                    'CSRFPreventionToken' => $this->PVE->getCSRFPreventionToken(),
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'exceptions' => false,
                'cookies' => $this->PVE->getCookie(),
            ]));
        } catch (GuzzleException $exception) {
            if ($this->PVE->getDebug()) {
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
            return $this->getBody($this->PVE->getHttpClient()->request('POST', $this->PVE->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->PVE->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => [
                    'CSRFPreventionToken' => $this->PVE->getCSRFPreventionToken(),
                    'Content-Type' => (count($params) > 0) ? 'application/json' : null,
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'exceptions' => false,
                'cookies' => $this->PVE->getCookie(),
                'json' => (count($params) > 0) ? $params : null,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->PVE->getDebug()) {
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
            return $this->getBody($this->PVE->getHttpClient()->request('PUT', $this->PVE->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->PVE->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => [
                    'CSRFPreventionToken' => $this->PVE->getCSRFPreventionToken(),
                    'Content-Type' => (count($params) > 0) ? 'application/json' : null,
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'exceptions' => false,
                'cookies' => $this->PVE->getCookie(),
                'json' => (count($params) > 0) ? $params : null,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->PVE->getDebug()) {
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
            return $this->getBody($this->PVE->getHttpClient()->request('DELETE', $this->PVE->getApiURL() . $path, [
                'verify' => false,
                'debug' => $this->PVE->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => [
                    'CSRFPreventionToken' => $this->PVE->getCSRFPreventionToken(),
                    'Content-Type' => (count($params) > 0) ? 'application/json' : null,
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'exceptions' => false,
                'cookies' => $this->PVE->getCookie(),
                'json' => (count($params) > 0) ? $params : null,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->PVE->getDebug()) {
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
        $requestResult = $this->getCSRFToken();
        $this->PVE->setCSRFPreventionToken($requestResult['CSRFPreventionToken']);
        $this->PVE->setTicket($requestResult['ticket']);
        $this->PVE->setCookie($this->getCookies());
    }

    /**
     * Get CSRF token data from proxmox api for api auth
     * @return array | null
     */
    public function getCSRFToken(): ?array
    {
        try {
            return $this->getBody($this->PVE->getHttpClient()->request('POST', $this->PVE->getApiURL() . 'access/ticket', [
                'verify' => false,
                'debug' => $this->PVE->getDebug() ? fopen('php://stderr', 'w') : null,
                'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'form_params' => [
                    'username' => $this->PVE->getUsername(),
                    'password' => $this->PVE->getPassword(),
                    'realm' => $this->PVE->getAuthType(),
                ],
            ]))['data'];
        } catch (GuzzleException $exception) {
            if ($this->PVE->getDebug()) {
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
        return CookieJar::fromArray([
            'PVEAuthCookie' => $this->PVE->getTicket(),
        ], $this->PVE->getHostname());
    }

}
