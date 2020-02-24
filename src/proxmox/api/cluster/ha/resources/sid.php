<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\cluster\ha\resources;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class sid
 * @package proxmox\api\cluster\ha\resources
 */
class sid
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * sid constructor.
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
     * Read resource configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/resources/{sid}
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update resource configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/resources/{sid}
     * @param $params array
     * @return mixed|null
     */
    public function put($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Request resource migration (online) to another node.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/resources/{sid}/migrate
     * @return mixed|null
     */
    public function postMigrate(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'migrate/',$this->cookie));
    }

    /**
     * Request resource relocatzion to another node. This stops the service on the old node, and restarts it on the target node.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/resources/{sid}/relocate
     * @return mixed|null
     */
    public function postRelocate(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'relocate/',$this->cookie));
    }

    /**
     * DELETE
     */

    /**
     * Delete resource configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/resources/{sid}
     * @return mixed|null
     */
    public function delete(){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

}