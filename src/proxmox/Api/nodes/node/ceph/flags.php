<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes\node\ceph;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class flags
 * @package proxmox\api\nodes\node\ceph
 */
class flags
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
     * get all set ceph flags
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/flags
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Set a specific ceph flag
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/flags/{flag}
     * @param $flag string
     * @return mixed
     */
    public function postFlag($flag){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$flag,$this->cookie));
    }

    /**
     * DELETE
     */

    /**
     * Unset a ceph flag
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/flags/{flag}
     * @param $flag string
     * @return mixed
     */
    public function deleteFlag($flag){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$flag,$this->cookie));
    }
}