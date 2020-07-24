<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\cluster\ceph;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class flags
 * @package proxmox\api\cluster\ceph
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
     * get the status of all ceph flags
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/flags
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get the status of a specific ceph flag.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/flags/{flag}
     * @param $flag mixed
     * @return mixed
     */
    public function getFlag($flag){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$flag.'/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Set/Unset multiple ceph flags at once.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/flags
     * @param $params array
     * @return mixed
     */
    public function put($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

    /**
     * Set or clear (unset) a specific ceph flag
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/flags/{flag}
     * @param $flag mixed
     * @param $params array
     * @return mixed
     */
    public function putFlag($flag,$params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$flag.'/',$this->cookie,$params));
    }

}