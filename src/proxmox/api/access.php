<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api;


use proxmox\api\access\domains;
use proxmox\helper\connection;

class access
{
    private $httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname,$cookie;

    public function __construct($httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname){
        $this->httpClient = $httpClient;
        $this->apiURL = $apiURL.'/api2/json/access/';
        $this->CSRFPreventionToken = $CSRFPreventionToken;
        $this->ticket = $ticket;
        $this->hostname = $hostname;
        $this->cookie = connection::getCookies($this->ticket,$this->hostname);
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
     * @return domains
     */
    public function domains(){
        return new domains($this->httpClient,$this->apiURL.'/domains/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }
}