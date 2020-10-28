<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace proxmox\Helper;

use GuzzleHttp\Cookie\CookieJar;
use proxmox\Exception\AuthenticationException;
use proxmox\pve;

/**
 * Class connection
 * @package proxmox\helper
 */
class connection
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
     * @param mixed $csrfTokenString
     */
    public static function setCsrfTokenString($csrfTokenString)
    {
        self::$csrfTokenString = $csrfTokenString;
    }

    /**
     * Get CSRF token data from proxmox api for api auth
     * @param $url string
     * @param $username string
     * @param $password string
     * @param $authType string
     * @param $debug boolean
     * @return mixed
     */
    public static function getCSRFToken($url, $username, $password, $authType, $debug)
    {
        return pve::getHttpClient()->post($url . '/api2/json/access/ticket', [
            'verify' => false,
            'debug' => $debug,
            'form_params' => [
                'username' => $username,
                'password' => $password,
                'realm' => $authType,
            ],
        ]);
    }

    /**
     * Get cookies for auth
     * @param $ticket string
     * @param $hostname string
     * @return CookieJar
     */
    public static function getCookies($ticket, $hostname)
    {
        return CookieJar::fromArray([
            'PVEAuthCookie' => $ticket,
        ], $hostname);
    }

    /**
     * Get function for get data from proxmox api
     * You can get information from the proxmox api with this function.
     * @param $httpClient
     * @param $url string
     * @param $cookies string
     * @param $param array
     * @return mixed
     */
    public static function getAPI($httpClient,$url, $cookies, $param = [])
    {
        if (!is_array($param)) {
            throw new AuthenticationException('No array with params for get');
        }
        return pve::getHttpClient()->get($url, [
            'verify' => false,
            'headers' => ['CSRFPreventionToken' => self::getCsrfTokenString()],
            'exceptions' => false,
            'cookies' => $cookies,
            'query' => $param,
        ]);
    }

    /**
     * Post function for post to proxmox api
     * You can post information to the proxmox api with this function.
     * @param $httpClient
     * @param $url string
     * @param $cookies string
     * @param $param array
     * @return mixed
     */
    public static function postAPI($httpClient,$url, $cookies, $param = [])
    {
        if (!is_array($param)) {
            throw new AuthenticationException('No array with params for post');
        }
        return pve::getHttpClient()->post($url, [
            'verify' => false,
            'headers' => ['CSRFPreventionToken' => self::getCsrfTokenString()],
            'exceptions' => false,
            'cookies' => $cookies,
            'query' => $param,
        ]);
    }

    /**
     * Put function for put to proxmox api
     * You can put information to the proxmox api with function.
     * @param $httpClient
     * @param $url string
     * @param $cookies string
     * @param $param array
     * @return mixed
     */
    public static function putAPI($httpClient,$url, $cookies, $param = [])
    {
        if (!is_array($param)) {
            throw new AuthenticationException('No array with params for put');
        }
        return pve::getHttpClient()->put($url, [
            'verify' => false,
            'headers' => ['CSRFPreventionToken' => self::getCsrfTokenString()],
            'exceptions' => false,
            'cookies' => $cookies,
            'query' => $param,
        ]);
    }

    /**
     * Delete function for delete to proxmox api
     * You can delete with this function vm's or other.
     * @param $httpClient
     * @param $url string
     * @param $cookies string
     * @param $param array
     * @return mixed
     */
    public static function deleteAPI($httpClient,$url, $cookies, $param = [])
    {
        if (!is_array($param)) {
            throw new AuthenticationException('No array with params for delete');
        }
        return pve::getHttpClient()->delete($url, [
            'verify' => false,
            'headers' => ['CSRFPreventionToken' => self::getCsrfTokenString()],
            'exceptions' => false,
            'cookies' => $cookies,
            'query' => $param,
        ]);
    }

    /**
     * Formatting the proxmox api response to array
     * @param $response mixed
     * @return mixed|null
     */
    public static function processHttpResponse($response)
    {
        if ($response === null) {
            return null;
        }
        return json_decode($response->getBody(), true);
    }

}