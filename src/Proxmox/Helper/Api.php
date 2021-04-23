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
class Api extends PVE
{

    /**
     * Get CSRF token data from proxmox api for api auth
     *
     * @return array | null
     */
    public function getCSRFToken(): ?array
    {
        try {
            return $this->getBody(PVE::getHttpClient()->request('POST', parent::getApiURL() . 'access/ticket', [
                'verify' => false,
                'debug' => parent::getDebug(),
                'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'form_params' => [
                    'username' => parent::getUsername(),
                    'password' => parent::getPassword(),
                    'realm' => parent::getAuthType(),
                ],
            ]))['data'];
        } catch (GuzzleException $exception) {
            if ($this->getDebug()) {
                print_r($exception->getMessage());
            }
            return null;
        }
    }

    /**
     * Get cookies for auth
     *
     * @return CookieJar
     */
    public function getCookies(): CookieJar
    {
        return CookieJar::fromArray([
            'PVEAuthCookie' => $this->getTicket(),
        ], $this->getHostname());
    }

    /**
     * Request information from proxmox api over type get
     *
     * @param string $path
     * @param array $params
     * @return array | null
     */
    public function get(string $path, array $params = []): ?array
    {
        try {
            return $this->getBody(PVE::getHttpClient()->request('GET', parent::getApiURL(), [
                'verify' => false,
                'debug' => parent::getDebug(),
                'headers' => [
                    'CSRFPreventionToken' => parent::getCSRFPreventionToken(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'exceptions' => false,
                'cookies' => parent::getCookie(),
                'json' => $params,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->getDebug()) {
                print_r($exception->getMessage());
            }
            return null;
        }
    }

    /**
     * Store new information in proxmox api over type post
     *
     * @param string $path
     * @param array $params
     * @return array | null
     */
    public function post(string $path, array $params = []): ?array
    {
        try {
            return $this->getBody(PVE::getHttpClient()->request('POST', parent::getApiURL(), [
                'verify' => false,
                'debug' => parent::getDebug(),
                'headers' => [
                    'CSRFPreventionToken' => parent::getCSRFPreventionToken(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'exceptions' => false,
                'cookies' => parent::getCookie(),
                'json' => $params,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->getDebug()) {
                print_r($exception->getMessage());
            }
            return null;
        }
    }

    /**
     * Update new information in proxmox api over type put
     *
     * @param string $path
     * @param array $params
     * @return array | null
     */
    public function put(string $path, array $params = []): ?array
    {
        try {
            return $this->getBody(PVE::getHttpClient()->request('PUT', parent::getApiURL(), [
                'verify' => false,
                'debug' => parent::getDebug(),
                'headers' => [
                    'CSRFPreventionToken' => parent::getCSRFPreventionToken(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'exceptions' => false,
                'cookies' => parent::getCookie(),
                'json' => $params,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->getDebug()) {
                print_r($exception->getMessage());
            }
            return null;
        }
    }

    /**
     * Delete new information in proxmox api over type delete
     *
     * @param string $path
     * @param array $params
     * @return array | null
     */
    public function delete(string $path, array $params = []): ?array
    {
        try {
            return $this->getBody(PVE::getHttpClient()->request('DELETE', parent::getApiURL(), [
                'verify' => false,
                'debug' => parent::getDebug(),
                'headers' => [
                    'CSRFPreventionToken' => parent::getCSRFPreventionToken(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'exceptions' => false,
                'cookies' => parent::getCookie(),
                'json' => $params,
            ]));
        } catch (GuzzleException $exception) {
            if ($this->getDebug()) {
                print_r($exception->getMessage());
            }
            return null;
        }
    }

    /**
     * Get response information as array
     *
     * @param ResponseInterface $response
     *
     * @return array|null
     */
    public function getBody(ResponseInterface $response): ?array
    {
        if ($response === null) {
            return null;
        }
        return json_decode($response->getBody(), true);
    }

    /**
     * Login to proxmox ve
     */
    public function login()
    {
        $requestResult = $this->getCSRFToken();
        $this->setCSRFPreventionToken($requestResult['CSRFPreventionToken']);
        $this->setTicket($requestResult['ticket']);
        $this->setCookie($this->getCookies());
    }

}