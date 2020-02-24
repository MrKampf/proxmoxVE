<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\node\disks;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class zfs
 * @package proxmox\api\nodes\node\disks
 */
class zfs
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * zfs constructor.
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
     * List Zpools.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks/zfs
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get details about a zpool.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks/zfs/{name}
     * @param $name string
     * @return mixed
     */
    public function getName($name){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$name.'/',$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Create a ZFS pool.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks/zfs
     * @param $params array
     * @return mixed
     */
    public function post($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }
}