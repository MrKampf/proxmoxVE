<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\node;

use GuzzleHttp\Client;
use proxmox\api\nodes\node\qemu\vmid;
use proxmox\helper\connection;

/**
 * Class qemu
 * @package proxmox\api\nodes\node
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
     * Directory index
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes
     * @param $vmId string
     * @return vmid
     */
    public function vmid($vmId){
        return new vmid($this->httpClient,$this->apiURL.$vmId.'/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Virtual machine index (per node).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }
}