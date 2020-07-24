<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes\node\hardware\pci;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class pciid
 * @package proxmox\api\nodes\node\hardware\pci
 */
class pciid
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * pci constructor.
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
     * GET
     */

    /**
     * Index of available pci methods
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/hardware/pci/{pciid}
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Index of available pci methods
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/hardware/pci/{pciid}/mdev
     * @return mixed|null
     */
    public function getMdev(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'mdev/',$this->cookie));
    }
}