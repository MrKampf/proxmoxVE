<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\node;

use GuzzleHttp\Client;
use proxmox\api\nodes\node\certificates\acme;
use proxmox\helper\connection;

/**
 * Class certificates
 * @package proxmox\api\nodes\node
 */
class certificates
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * certificates constructor.
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
     * ACME index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/certificates/acme
     * @return acme
     */
    public function Acme(){
        return new acme($this->httpClient,$this->apiURL.'acme/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Node index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/certificates
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get information about node's certificates
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/certificates/info
     * @return mixed
     */
    public function getInfo(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'info/',$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Upload or update custom certificate chain and key.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/certificates/custom
     * @param $param
     * @return mixed
     */
    public function postCustom($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'custom/',$this->cookie,$param));
    }

    /**
     * DELETE
     */

    /**
     * DELETE custom certificate chain and key.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/certificates/custom
     * @param $param
     * @return mixed
     */
    public function deleteCustom($param){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.'custom/',$this->cookie,$param));
    }
}