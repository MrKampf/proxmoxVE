<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes\lxc\firewall\ipset;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class name
 * @package proxmox\api\nodes\lxc\firewall\ipset
 */
class name
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * name constructor.
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
     * List IPSet content
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/ipset/{name}
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient, $this->apiURL, $this->cookie));
    }

    /**
     * Read IP or Network settings from IPSet.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/ipset/{name}/{cidr}
     * @param $cidr
     * @return mixed|null
     */
    public function getCidr($cidr){
        return connection::processHttpResponse(connection::getAPI($this->httpClient, $this->apiURL.$cidr.'/', $this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update IP or Network settings
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/ipset/{name}/{cidr}
     * @param $cidr
     * @param $param array
     * @return mixed|null
     */
    public function putCidr($cidr,$param){
        return connection::processHttpResponse(connection::putAPI($this->httpClient, $this->apiURL.$cidr.'/', $this->cookie, $param));
    }

    /**
     * POST
     */

    /**
     * Add IP or Network to IPSet.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/ipset/{name}
     * @param $param array
     * @return mixed|null
     */
    public function post($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient, $this->apiURL, $this->cookie, $param));
    }

    /**
     * DELETE
     */

    /**
     * Delete IPSet
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/ipset/{name}
     * @return mixed|null
     */
    public function delete(){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient, $this->apiURL, $this->cookie));
    }

    /**
     * Remove IP or Network from IPSet.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/ipset/{name}/{cidr}
     * @param $cidr
     * @param $param array
     * @return mixed|null
     */
    public function deleteCidr($cidr,$param){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient, $this->apiURL.$cidr.'/', $this->cookie, $param));
    }
}