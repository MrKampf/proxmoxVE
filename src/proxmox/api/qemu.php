<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api;

use proxmox\helper\connection;

class qemu
{
    private $httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname,$cookie;

    public function __construct($httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname,$cookie){
        $this->httpClient = $httpClient;
        $this->apiURL = $apiURL.'qemu/';
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
     * @param $vmid
     * @return mixed|null
     */
    public function getQemu($vmid){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$vmid,$this->cookie,[]));
    }
}