<?php
/*
 * @copyright  2020 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace proxmox\Helper;

use GuzzleHttp\Exception\GuzzleException;
use proxmox\pve;
use Psr\Http\Message\ResponseInterface;

/**
 * Class api
 * @package proxmox\Helper
 */
class api
{

    private static $csrfTokenString;

    /**
     * @return mixed
     */
    public static function getCsrfTokenString()
    {
        return self::$csrfTokenString;
    }

    /**
     * @param string $csrfTokenString
     */
    public static function setCsrfTokenString(string $csrfTokenString)
    {
        self::$csrfTokenString = $csrfTokenString;
    }

    /**
     * Get CSRF token data from proxmox api for api auth
     *
     * @param string $url
     * @param string $username
     * @param $password
     * @param string $authType
     * @param bool $debug
     * @return mixed
     * @throws GuzzleException
     */
    public static function getCSRFToken(string $url, string $username, $password, string $authType, bool$debug)
    {
        return pve::getHttpClient()->request('POST', $url . '/api2/json/access/ticket', [
            'verify' => false,
            'debug' => $debug,
            'headers' => [
                'Accept' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
            'form_params' => [
                'username' => $username,
                'password' => $password,
                'realm' => $authType,
            ],
        ]);
    }

    /**
     * Request information from proxmox api over type get
     *
     * @param string $url
     * @param string $authCookie
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function get(string $url, string $authCookie, array $params = [])
    {
        return pve::getHttpClient()->request('GET', $url, [
            'verify' => false,
            'headers' => [
                'CSRFPreventionToken' => self::getCsrfTokenString(),
                'Accept' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
            'exceptions' => false,
            'cookies' => $authCookie,
            'query' => $params,
        ]);
    }

    /**
     * Store new information in proxmox api over type post
     *
     * @param string $url
     * @param string $authCookie
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function post(string $url, string $authCookie, array $params = [])
    {
        return pve::getHttpClient()->request('POST', $url, [
            'verify' => false,
            'headers' => [
                'CSRFPreventionToken' => self::getCsrfTokenString(),
                'Accept' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
            'exceptions' => false,
            'cookies' => $authCookie,
            'query' => $params,
        ]);
    }

    /**
     * Update new information in proxmox api over type put
     *
     * @param string $url
     * @param string $authCookie
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function put(string $url, string $authCookie, array $params = [])
    {
        return pve::getHttpClient()->request('PUT', $url, [
            'verify' => false,
            'headers' => [
                'CSRFPreventionToken' => self::getCsrfTokenString(),
                'Accept' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
            'exceptions' => false,
            'cookies' => $authCookie,
            'query' => $params,
        ]);
    }

    /**
     * Delete new information in proxmox api over type delete
     *
     * @param string $url
     * @param string $authCookie
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function delete(string $url, string $authCookie, array $params = [])
    {
        return pve::getHttpClient()->request('DELETE', $url, [
            'verify' => false,
            'headers' => [
                'CSRFPreventionToken' => self::getCsrfTokenString(),
                'Accept' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
            'exceptions' => false,
            'cookies' => $authCookie,
            'query' => $params,
        ]);
    }

    /**
     * Get response information as array
     *
     * @param ResponseInterface $response
     * @return mixed
     */
    public static function getBody(ResponseInterface $response)
    {
        return json_decode($response->getBody(), true);
    }

}