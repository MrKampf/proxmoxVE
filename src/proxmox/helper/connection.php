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


    public static function getCookies($ticket,$hostname){
        return CookieJar::fromArray([
            'PVEAuthCookie' => $ticket,
        ], $hostname);
    }

    public static function getAPI($httpClient,$url,$cookies,$param){
        if(!is_array($param)){
            $errorMSG = "No array";
            throw new AuthenticationException($errorMSG);
        }
        return $httpClient->get($url, [
            'verify' => false,
            'exceptions' => false,
            'cookies' => $cookies,
            'query' => $param,
        ]);
    }

    public static function postAPI($httpClient,$url,$cookies,$param){
        if(!is_array($param)){
            $errorMSG = "No array";
            throw new AuthenticationException($errorMSG);
        }
        return $httpClient->post($url, [
            'verify' => false,
            'exceptions' => false,
            'cookies' => $cookies,
            'query' => $param,
        ]);
    }

    public static function putAPI($httpClient,$url,$cookies,$param){
        if(!is_array($param)){
            $errorMSG = "No array";
            throw new AuthenticationException($errorMSG);
        }
        return $httpClient->put($url, [
            'verify' => false,
            'exceptions' => false,
            'cookies' => $cookies,
            'query' => $param,
        ]);
    }

    public static function deleteAPI($httpClient,$url,$cookies,$param){
        if(!is_array($param)){
            $errorMSG = "No array";
            throw new AuthenticationException($errorMSG);
        }
        return $httpClient->delete($url, [
            'verify' => false,
            'exceptions' => false,
            'cookies' => $cookies,
            'query' => $param,
        ]);
    }

    public static function processHttpResponse($response){
        if ($response === null) {
            return null;
        }
        return json_decode($response->getBody(), true);
    }

}