<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace proxmox\Helper;

use GuzzleHttp\Exception\GuzzleException;
use proxmox\pve;
use Psr\Http\Message\ResponseInterface;

/**
 * Class api
 * @package proxmox\Helper
 */
class api extends pve
{

    /**
     * Get CSRF token data from proxmox api for api auth
     *
     * @param string $url
     * @param string $username
     * @param string $password
     * @param string $authType
     * @return ResponseInterface | null
     */
    public function getCSRFToken(string $url, string $username, string $password, string $authType): ?ResponseInterface
    {
        try {
            return $this->getBody(pve::getHttpClient()->request('POST', $url . '/api2/json/access/ticket', [
                'verify' => false,
                'debug' => parent::getDebug(),
                'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'form_params' => [
                    'username' => $username,
                    'password' => $password,
                    'realm' => $authType,
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
     * Request information from proxmox api over type get
     *
     * @param string $url
     * @param string $authCookie
     * @param array $params
     * @return ResponseInterface | null
     */
    public function get(string $url, string $authCookie, array $params = []): ?ResponseInterface
    {
        try {
            return $this->getBody(pve::getHttpClient()->request('GET', $url, [
                'verify' => false,
                'debug' => parent::getDebug(),
                'headers' => [
                    'CSRFPreventionToken' => parent::getCSRFPreventionToken(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'exceptions' => false,
                'cookies' => $authCookie,
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
     * @param string $url
     * @param string $authCookie
     * @param array $params
     * @return ResponseInterface | null
     */
    public function post(string $url, string $authCookie, array $params = []): ?ResponseInterface
    {
        try {
            return $this->getBody(pve::getHttpClient()->request('POST', $url, [
                'verify' => false,
                'debug' => parent::getDebug(),
                'headers' => [
                    'CSRFPreventionToken' => parent::getCSRFPreventionToken(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'exceptions' => false,
                'cookies' => $authCookie,
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
     * @param string $url
     * @param string $authCookie
     * @param array $params
     * @return ResponseInterface | null
     */
    public function put(string $url, string $authCookie, array $params = []): ?ResponseInterface
    {
        try {
            return $this->getBody(pve::getHttpClient()->request('PUT', $url, [
                'verify' => false,
                'debug' => parent::getDebug(),
                'headers' => [
                    'CSRFPreventionToken' => parent::getCSRFPreventionToken(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'exceptions' => false,
                'cookies' => $authCookie,
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
     * @param string $url
     * @param string $authCookie
     * @param array $params
     * @return ResponseInterface | null
     */
    public function delete(string $url, string $authCookie, array $params = []): ?ResponseInterface
    {
        try {
            return $this->getBody(pve::getHttpClient()->request('DELETE', $url, [
                'verify' => false,
                'debug' => parent::getDebug(),
                'headers' => [
                    'CSRFPreventionToken' => parent::getCSRFPreventionToken(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                ],
                'exceptions' => false,
                'cookies' => $authCookie,
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

    public function login()
    {
        try {
            $requestResult = $this->getCSRFToken($this->getApiURL(), $this->getUsername(), $this->getPassword(), $this->getAuthType());
            $this->setCSRFPreventionToken($requestResult['CSRFPreventionToken']);
            $this->setTicket($requestResult['ticket']);
        } catch (GuzzleException $exception) {

        }

    }

}