<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes\node\lxc\vmid;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class status
 * @package proxmox\api\nodes\node\lxc\vmid
 */
class status
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * status constructor.
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
     * Directory index
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/status
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get virtual machine status.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/status/current
     * @return mixed|null
     */
    public function getCurrent(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'current/',$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Reboot the container by shutting it down, and starting it again. Applies pending changes.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/status/reboot
     * @param $params array
     * @return mixed|null
     */
    public function postReboot($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'reboot/',$this->cookie,$params));
    }

    /**
     * Resume the container.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/status/resume
     * @return mixed|null
     */
    public function postResume(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'resume/',$this->cookie));
    }

    /**
     * Shutdown the container. This will trigger a clean shutdown of the container, see lxc-stop(1) for details.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/status/shutdown
     * @param $params array
     * @return mixed|null
     */
    public function postShutdown($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'shutdown/',$this->cookie,$params));
    }

    /**
     * Start the container.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/status/start
     * @param $params array
     * @return mixed|null
     */
    public function postStart($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'start/',$this->cookie,$params));
    }

    /**
     * Stop the container. This will abruptly stop all processes running in the container.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/status/stop
     * @param $params array
     * @return mixed|null
     */
    public function postStop($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'stop/',$this->cookie,$params));
    }

    /**
     * Suspend the container.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/status/suspend
     * @return mixed|null
     */
    public function postSuspend(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'suspend/',$this->cookie));
    }
}