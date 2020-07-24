<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes\node\qemu\vmid;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class cloudinit
 * @package proxmox\api\nodes\node\qemu\vmid
 */
class cloudinit
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * cloudinit constructor.
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
     * Get automatically generated cloudinit config.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/cloudinit/dump
     * @param $params array
     * @return mixed
     */
    public function getDump($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'dump/',$this->cookie,$params));
    }

}