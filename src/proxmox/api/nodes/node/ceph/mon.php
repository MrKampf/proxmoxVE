<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\node\ceph;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class mon
 * @package proxmox\api\nodes\node\ceph
 */
class mon
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * mon constructor.
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
     * Get Ceph monitor list.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/mon
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Create Ceph Monitor and Manager
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/mon/{monid}
     * @param $monId string
     * @param $params array
     * @return mixed
     */
    public function postFlag($monId,$params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$monId,$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * Destroy Ceph Monitor and Manager.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/mon/{monid}
     * @param $monId string
     * @return mixed
     */
    public function deleteFlag($monId){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$monId,$this->cookie));
    }

}