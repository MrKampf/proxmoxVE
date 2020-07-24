<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes\node\ceph;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class pools
 * @package proxmox\api\nodes\node\ceph
 */
class pools
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * flags constructor.
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
     * List all pools.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/pools
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Create POOL
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/pools
     * @param $params array
     * @return mixed
     */
    public function post($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * Destroy pool
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/pools/{name}
     * @param $name string
     * @param $params string
     * @return mixed
     */
    public function deleteName($name,$params){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$name.'/',$this->cookie,$params));
    }

}