<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace proxmox\Helper;

use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\GuzzleException;
use proxmox\pve;
use Psr\Http\Message\ResponseInterface;

/**
 * Class api
 * @package proxmox\Helper
 */
class Api extends pve
{

    /**
     * Get CSRF token data from proxmox api for api auth
     *
     * @return ResponseInterface | null
     */
    public function getCSRFToken(): ?ResponseInterface
    {
        try {
            return $this->getBody(pve::getHttpClient()->request('POST', parent::getApiURL() . '/api2/json/access/ticket', [
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
     * @param array $params
     * @return ResponseInterface | null
     */
    public function get(array $params = []): ?ResponseInterface
    {
        try {
            return $this->getBody(pve::getHttpClient()->request('GET', parent::getApiURL(), [
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
     * @param array $params
     * @return ResponseInterface | null
     */
    public function post(array $params = []): ?ResponseInterface
    {
        try {
            return $this->getBody(pve::getHttpClient()->request('POST', parent::getApiURL(), [
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
     * @param array $params
     * @return ResponseInterface | null
     */
    public function put(array $params = []): ?ResponseInterface
    {
        try {
            return $this->getBody(pve::getHttpClient()->request('PUT', parent::getApiURL(), [
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
     * @param array $params
     * @return ResponseInterface | null
     */
    public function delete(array $params = []): ?ResponseInterface
    {
        try {
            return $this->getBody(pve::getHttpClient()->request('DELETE', parent::getApiURL(), [
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
     * @return mixed
     */
    public function getBody(ResponseInterface $response)
    {
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