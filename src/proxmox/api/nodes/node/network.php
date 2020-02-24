<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\node;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class network
 * @package proxmox\api\nodes\node
 */
class network
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * network constructor.
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
     * List available networks
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/network
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Read network device configuration
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/network/{iface}
     * @param $iface string
     * @return mixed
     */
    public function getIface($iface){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$iface.'/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * List available networks
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/network
     * @return mixed
     */
    public function put(){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Update network device configuration
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/network/{iface}
     * @param $iface string
     * @param $params array
     * @return mixed
     */
    public function putIface($iface,$params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$iface.'/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Create network device configuration
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/network
     * @param $params array
     * @return mixed
     */
    public function post($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * List available networks
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/network
     * @return mixed
     */
    public function delete(){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Delete network device configuration
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/network/{iface}
     * @param $iface string
     * @return mixed
     */
    public function deleteIface($iface){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$iface.'/',$this->cookie));
    }

}