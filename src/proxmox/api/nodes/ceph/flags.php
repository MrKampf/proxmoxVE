<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\ceph;


use proxmox\helper\connection;

class flags
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
     * @param $flag
     * @return mixed
     */
    public function postFlag($flag){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$flag,$this->cookie,[]));
    }

    /**
     * @param $flag
     * @return mixed
     */
    public function deleteFlag($flag){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$flag,$this->cookie,[]));
    }
}