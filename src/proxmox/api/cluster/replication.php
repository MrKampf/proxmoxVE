<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\cluster;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class replication
 * @package proxmox\api\cluster
 */
class replication
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * replication constructor.
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
     * List replication jobs.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/replication
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Read replication job configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/replication/{id}
     * @param $id string
     * @return mixed|null
     */
    public function getId($id){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$id.'/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update replication job configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/replication/{id}
     * @param $id string
     * @param $params array
     * @return mixed|null
     */
    public function putId($id,$params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$id.'/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Create a new replication job
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/replication
     * @param $params array
     * @return mixed|null
     */
    public function post($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * Mark replication job for removal.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/replication/{id}
     * @param $id string
     * @param $params array
     * @return mixed|null
     */
    public function deleteId($id,$params){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$id.'/',$this->cookie,$params));
    }

}