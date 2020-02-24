<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\node\lxc;

use GuzzleHttp\Client;
use proxmox\api\nodes\node\lxc\vmid\firewall;
use proxmox\api\nodes\node\lxc\vmid\snapshot;
use proxmox\api\nodes\node\lxc\vmid\status;
use proxmox\helper\connection;

/**
 * Class vmid
 * @package proxmox\api\nodes\node\lxc
 */
class vmid
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
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall
     * @return firewall
     */
    public function firewall(){
        return new firewall($this->httpClient,$this->apiURL.'firewall/',$this->cookie);
    }

    /**
     * List all snapshots.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/snapshot
     * @return snapshot
     */
    public function snapshot(){
        return new snapshot($this->httpClient,$this->apiURL.'snapshot/',$this->cookie);
    }

    /**
     * Directory index
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/status
     * @return status
     */
    public function status(){
        return new status($this->httpClient,$this->apiURL.'status/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Directory index
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get container configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/config
     * @param $params array
     * @return mixed|null
     */
    public function getConfig($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'config/',$this->cookie,$params));
    }

    /**
     * Check if feature for virtual machine is available.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/feature
     * @param $params array
     * @return mixed|null
     */
    public function getFeature($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'feature/',$this->cookie,$params));
    }

    /**
     * Get container configuration, including pending changes.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/pending
     * @return mixed|null
     */
    public function getPending(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'pending/',$this->cookie));
    }

    /**
     * Read VM RRD statistics (returns PNG)
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/rrd
     * @param $params array
     * @return mixed|null
     */
    public function getRrd($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'rrd/',$this->cookie,$params));
    }

    /**
     * Read VM RRD statistics
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/rrddata
     * @param $params array
     * @return mixed|null
     */
    public function getRrdData($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'rrddata/',$this->cookie,$params));
    }

    /**
     * Opens a weksocket for VNC traffic.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/vncwebsocket
     * @param $params array
     * @return mixed|null
     */
    public function getVncWebsocket($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'vncwebsocket/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Create a container clone/copy
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/clone
     * @param $params array
     * @return mixed|null
     */
    public function postClone($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'clone/',$this->cookie,$params));
    }

    /**
     * Migrate the container to another node. Creates a new migration task.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/migrate
     * @param $params array
     * @return mixed|null
     */
    public function postMigrate($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'migrate/',$this->cookie,$params));
    }

    /**
     * Move a rootfs-/mp-volume to a different storage
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/move_volume
     * @param $params array
     * @return mixed|null
     */
    public function postMoveVolume($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'move_volume/',$this->cookie,$params));
    }

    /**
     * Returns a SPICE configuration to connect to the CT.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/spiceproxy
     * @param $params array
     * @return mixed|null
     */
    public function postSpiceProxy($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'spiceproxy/',$this->cookie,$params));
    }

    /**
     * Create a Template.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/template
     * @return mixed|null
     */
    public function postTemplate(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'template/',$this->cookie));
    }

    /**
     * Creates a TCP proxy connection.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/termproxy
     * @return mixed|null
     */
    public function postTermProxy(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'termproxy/',$this->cookie));
    }

    /**
     * Creates a TCP VNC proxy connections.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/vncproxy
     * @param $params array
     * @return mixed|null
     */
    public function postVncProxy($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'vncproxy/',$this->cookie,$params));
    }

    /**
     * PUT
     */

    /**
     * Set container options.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/config
     * @param $params array
     * @return mixed|null
     */
    public function putConfig($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'config/',$this->cookie,$params));
    }

    /**
     * Resize a container mount point.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/resize
     * @param $params array
     * @return mixed|null
     */
    public function putResize($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'resize/',$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * Destroy the container (also delete all uses files).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}
     * @param $params array
     * @return mixed|null
     */
    public function delete($params){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

}