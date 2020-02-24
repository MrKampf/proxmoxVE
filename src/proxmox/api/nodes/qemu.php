<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class qemu
 * @package proxmox\api\nodes
 */
class qemu
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * qemu constructor.
     * @param $httpClient Client
     * @param $apiURL string
     * @param $cookie mixed
     */
    public function __construct($httpClient,$apiURL,$cookie){
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL; //Save api url in class variable and change this to current api path
        $this->cookie = $cookie; //Save auth cookie in class variable
    }

    /**
     * API path - (https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes)
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * API path - (https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node})
     * @param $vmid
     * @return mixed|null
     */
    public function getQemu($vmid){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$vmid,$this->cookie));
    }
}