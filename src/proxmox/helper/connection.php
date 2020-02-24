<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\helper;

use GuzzleHttp\Cookie\CookieJar;
use proxmox\Exception\AuthenticationException;

class connection
{

    /**
     * Get CSRF token data from proxmox api for api auth
     * @param $httpClient
     * @param $url
     * @param $username
     * @param $password
     * @param $authType
     * @param $debug
     * @return mixed
     */
    public static function getCSRFToken($httpClient,$url,$username,$password,$authType,$debug){
        return $httpClient->post($url.'/api2/json/access/ticket', [
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
     * @param $ticket
     * @param $hostname
     * @return CookieJar
     */
    public static function getCookies($ticket,$hostname){
        return CookieJar::fromArray([
            'PVEAuthCookie' => $ticket,
        ], $hostname);
    }

    /**
     * Get function for get data from proxmox api
     * You can get information from the proxmox api with this function.
     * @param $httpClient
     * @param $url
     * @param $cookies
     * @param $param
     * @return mixed
     */
    public static function getAPI($httpClient,$url,$cookies,$param=[]){
        if(!is_array($param)){
            throw new AuthenticationException('No array with params for get');
        }
        return $httpClient->get($url, [
            'verify' => false,
            'exceptions' => false,
            'cookies' => $cookies,
            'query' => $param,
        ]);
    }

    /**
     * Post function for post to proxmox api
     * You can post information to the proxmox api with this function.
     * @param $httpClient
     * @param $url
     * @param $cookies
     * @param $param
     * @return mixed
     */
    public static function postAPI($httpClient,$url,$cookies,$param=[]){
        if(!is_array($param)){
            throw new AuthenticationException('No array with params for post');
        }
        return $httpClient->post($url, [
            'verify' => false,
            'exceptions' => false,
            'cookies' => $cookies,
            'query' => $param,
        ]);
    }

    /**
     * Put function for put to proxmox api
     * You can put information to the proxmox api with function.
     * @param $httpClient
     * @param $url
     * @param $cookies
     * @param $param
     * @return mixed
     */
    public static function putAPI($httpClient,$url,$cookies,$param=[]){
        if(!is_array($param)){
            throw new AuthenticationException('No array with params for put');
        }
        return $httpClient->put($url, [
            'verify' => false,
            'exceptions' => false,
            'cookies' => $cookies,
            'query' => $param,
        ]);
    }

    /**
     * Delete function for delete to proxmox api
     * You can delete with this function vm's or other.
     * @param $httpClient
     * @param $url
     * @param $cookies
     * @param $param
     * @return mixed
     */
    public static function deleteAPI($httpClient,$url,$cookies,$param=[]){
        if(!is_array($param)){
            throw new AuthenticationException('No array with params for delete');
        }
        return $httpClient->delete($url, [
            'verify' => false,
            'exceptions' => false,
            'cookies' => $cookies,
            'query' => $param,
        ]);
    }

    /**
     * Formatting the proxmox api response to array
     * @param $response
     * @return mixed|null
     */
    public static function processHttpResponse($response){
        if ($response === null) {
            return null;
        }
        return json_decode($response->getBody(), true);
    }

}