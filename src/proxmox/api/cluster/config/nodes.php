<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\cluster\config;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class nodes
 * @package proxmox\api\cluster\config
 */
class nodes
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * nodes constructor.
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
     * Corosync node list.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/config/nodes
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Adds a node to the cluster configuration. This call is for internal use.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/config/nodes/{node}
     * @param $node string
     * @param $params array
     * @return mixed
     */
    public function postNode($node,$params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/',$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * Removes a node from the cluster configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/config/nodes/{node}
     * @param $node string
     * @return mixed
     */
    public function deleteNode($node){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$node.'/',$this->cookie));
    }

}