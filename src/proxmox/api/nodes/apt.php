<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes;


use proxmox\helper\connection;

class apt
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
    public function getChangelog($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'changelog',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getUpdate($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'update',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getVersion($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'version',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function postUpdate($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'update',$this->cookie,$param));
    }
}