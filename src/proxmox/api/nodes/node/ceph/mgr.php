<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\node\ceph;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class mgr
 * @package proxmox\api\nodes\node\ceph
 */
class mgr
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * mgr constructor.
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
     * MGR directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/mgr
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Create Ceph Manager
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/mgr
     * @param $id string
     * @return mixed
     */
    public function postID($id){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$id.'/',$this->cookie));
    }

    /**
     * DELETE
     */

    /**
     * Destroy Ceph Manager.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/mgr
     * @param $id string
     * @return mixed
     */
    public function deleteName($id){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$id.'/',$this->cookie));
    }
}