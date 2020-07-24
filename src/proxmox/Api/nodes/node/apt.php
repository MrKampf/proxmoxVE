<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes\node;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class apt
 * @package proxmox\api\nodes\node
 */
class apt
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * apt constructor.
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
     * Directory index for apt (Advanced Package Tool).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/apt
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get package changelogs.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/apt/changelog
     * @param $param
     * @return mixed
     */
    public function getChangelog($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'changelog/',$this->cookie,$param));
    }

    /**
     * List available updates.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/apt/update
     * @return mixed
     */
    public function getUpdate(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'update/',$this->cookie));
    }

    /**
     * Get package information for important Proxmox packages.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/apt/version
     * @param $param
     * @return mixed
     */
    public function getVersion($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'version/',$this->cookie,$param));
    }

    /**
     * POST
     */

    /**
     * This is used to resynchronize the package index files from their sources (apt-get update).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/apt/update
     * @param $param
     * @return mixed
     */
    public function postUpdate($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'update/',$this->cookie,$param));
    }
}