<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\cluster;

use GuzzleHttp\Client;
use proxmox\Api\cluster\config\nodes;
use proxmox\Helper\connection;

/**
 * Class config
 * @package proxmox\api\cluster
 */
class config
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * config constructor.
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
     * Corosync node list.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/config/nodes
     * @return nodes
     */
    public function nodes(){
        return new nodes($this->httpClient,$this->apiURL.'nodes/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/config
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get information needed to join this cluster over the connected node.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/config/join
     * @return mixed
     */
    public function getJoin(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'join/',$this->cookie));
    }

    /**
     * Get QDevice status
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/config/qdevice
     * @return mixed
     */
    public function getQdevice(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'qdevice/',$this->cookie));
    }

    /**
     * Get corosync totem protocol settings.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/config/totem
     * @return mixed
     */
    public function getTotem(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'totem/',$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Generate new cluster configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/config
     * @param $params
     * @return mixed
     */
    public function post($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

    /**
     * Joins this node into an existing cluster.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/config/join
     * @param $params
     * @return mixed
     */
    public function postJoin($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'join/',$this->cookie,$params));
    }

}