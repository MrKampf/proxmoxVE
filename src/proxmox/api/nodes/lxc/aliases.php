<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\lxc;


use proxmox\helper\connection;

class aliases
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
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,[]));
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function getName($name){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$name,$this->cookie,[]));
    }

    /**
     * @param $param
     * @return mixed|null
     */
    public function post($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$param));
    }

    /**
     * @param $name
     * @param $param
     * @return mixed|null
     */
    public function postName($name,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$name,$this->cookie,$param));
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function deleteName($name){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$name,$this->cookie,[]));
    }
}