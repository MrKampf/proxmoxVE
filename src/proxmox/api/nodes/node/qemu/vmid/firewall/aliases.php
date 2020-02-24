<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\qemu\firewall;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class aliases
 * @package proxmox\api\nodes\qemu\firewall
 */
class aliases
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * aliases constructor.
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
     * List aliases
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/firewall/aliases
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Read alias.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/firewall/aliases/{name}
     * @param $name string
     * @return mixed|null
     */
    public function getName($name){
        return connection::processHttpResponse(connection::getAPI($this->httpClient, $this->apiURL.$name.'/', $this->cookie));
    }

    /**
     * POST
     */

    /**
     * Create IP or Network Alias.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/firewall/aliases
     * @param $param array
     * @return mixed|null
     */
    public function post($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$param));
    }

    /**
     * Update IP or Network alias.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/firewall/aliases/{name}
     * @param $name string
     * @param $param array
     * @return mixed|null
     */
    public function postName($name,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient, $this->apiURL.$name.'/', $this->cookie, $param));
    }

    /**
     * DELETE
     */

    /**
     * Remove IP or Network alias.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/firewall/aliases/{name}
     * @param $name string
     * @param $param array
     * @return mixed|null
     */
    public function deleteName($name,$param){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient, $this->apiURL.$name.'/', $this->cookie, $param));
    }
}