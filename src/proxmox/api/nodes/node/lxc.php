<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\node;

use GuzzleHttp\Client;
use proxmox\api\nodes\node\lxc\vmid;
use proxmox\helper\connection;

/**
 * Class lxc
 * @package proxmox\api\nodes\node
 */
class lxc
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $apiURLWithVmid, //API url with vm id
        $cookie; //Proxmox auth cookie

    /**
     * lxc constructor.
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
     * LXC container index (per node).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}
     * @param $vmId integer VMID (unique) ID of the vm
     * @return vmid
     */
    public function vmid($vmId){
        return new vmid($this->httpClient,$this->apiURL.$vmId.'/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * LXC container index (per node).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Create or restore a container.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc
     * @param $params array
     * @return mixed|null
     */
    public function post($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }
}