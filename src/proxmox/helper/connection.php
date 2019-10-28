<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\helper;

use GuzzleHttp\Cookie\CookieJar;
use proxmox\Exception\AuthenticationException;

class connection
{

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