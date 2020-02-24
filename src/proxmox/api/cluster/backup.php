<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\cluster;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class backup
 * @package proxmox\api\cluster
 */
class backup
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * acme constructor.
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
     * List vzdump backup schedule.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Read vzdump backup job definition.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup/{id}
     * @param $id string
     * @return mixed
     */
    public function getId($id){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$id.'/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update vzdump backup job definition.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup/{id}
     * @param $id string
     * @param $params array
     * @return mixed
     */
    public function putId($id,$params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$id.'/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Create new vzdump backup job.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup
     * @param $params array
     * @return mixed
     */
    public function post($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * Delete vzdump backup job definition.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup/{id}
     * @param $id string
     * @return mixed
     */
    public function deleteId($id){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$id.'/',$this->cookie));
    }

}