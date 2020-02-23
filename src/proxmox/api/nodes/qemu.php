<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes;

use proxmox\helper\connection;

/**
 * Class qemu
 * @package proxmox\api\nodes
 */
class qemu
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $CSRFPreventionToken, //CSRF token for auth
        $ticket, //Auth ticket
        $hostname, //Pormxox hostname
        $cookie; //Proxmox auth cookie

    /**
     * qemu constructor.
     * @param $httpClient
     * @param $apiURL
     * @param $CSRFPreventionToken
     * @param $ticket
     * @param $hostname
     * @param $cookie
     */
    public function __construct($httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname,$cookie){
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL; //Save api url in class variable and change this to current api path
        $this->CSRFPreventionToken = $CSRFPreventionToken; //Save CSRF token in class variable
        $this->ticket = $ticket; //Save auth ticket in class variable
        $this->hostname = $hostname; //Save hostname in class variable
        $this->cookie = $cookie; //Save auth cookie in class variable
    }

    /**
     * API path - (https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes)
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,[]));
    }

    /**
     * API path - (https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node})
     * @param $vmid
     * @return mixed|null
     */
    public function getQemu($vmid){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$vmid,$this->cookie,[]));
    }
}