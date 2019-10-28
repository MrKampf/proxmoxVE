<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\access;

use proxmox\helper\connection;

class domains
{
    private $httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname,$cookie;

    public function __construct($httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname,$cookie){
        $this->httpClient = $httpClient;
        $this->apiURL = $apiURL;
        $this->CSRFPreventionToken = $CSRFPreventionToken;
        $this->ticket = $ticket;
        $this->hostname = $hostname;
        $this->cookie = $cookie;
    }

    /**
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,[]));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function post($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$param));
    }

    /**
     * @param $realm
     * @return mixed|null
     */
    public function getRealm($realm){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$realm,$this->cookie,[]));
    }

    /**
     * @param $realm
     * @param $param
     * @return mixed|null
     */
    public function postRealm($realm,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$realm,$this->cookie,$param));
    }

    /**
     * @param $realm
     * @return mixed|null
     */
    public function deleteRealm($realm){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$realm,$this->cookie,[]));
    }
}