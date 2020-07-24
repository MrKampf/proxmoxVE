<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes\node;

use GuzzleHttp\Client;
use proxmox\Api\nodes\node\hardware\pci;
use proxmox\Helper\connection;

/**
 * Class hardware
 * @package proxmox\api\nodes\node
 */
class hardware
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * hardware constructor.
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
     * Index of hardware types
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/hardware
     * @return pci
     */
    public function pci(){
        return new pci($this->httpClient,$this->apiURL.'pci/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Index of hardware types
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/hardware
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }
}