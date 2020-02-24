<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\hardware;


use proxmox\helper\connection;

class pci
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
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * @return mixed|null
     */
    public function getPCIID($pciid){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$pciid,$this->cookie));
    }

    /**
     * @param $pciid
     * @return pciid
     */
    public function pciid($pciid){
        return new pciid($this->httpClient,$this->apiURL.$pciid.'/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }
}