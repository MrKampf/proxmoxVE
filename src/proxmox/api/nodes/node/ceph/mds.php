<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\node\ceph;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class mds
 * @package proxmox\api\nodes\node\ceph
 */
class mds
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * mds constructor.
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
     * MDS directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/mds
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Create Ceph Metadata Server (MDS)
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/mds
     * @param $name string
     * @param $param array
     * @return mixed
     */
    public function postName($name,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$name.'/',$this->cookie,$param));
    }

    /**
     * DELETE
     */

    /**
     * Destroy Ceph Metadata Server
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/mds
     * @param $name string
     * @return mixed
     */
    public function deleteName($name){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$name.'/',$this->cookie));
    }
}