<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes\node\qemu;

use GuzzleHttp\Client;
use proxmox\Api\nodes\node\qemu\vmid\agent;
use proxmox\Api\nodes\node\qemu\vmid\cloudinit;
use proxmox\Api\nodes\node\qemu\vmid\firewall;
use proxmox\Api\nodes\node\qemu\vmid\snapshot;
use proxmox\Api\nodes\node\qemu\vmid\status;
use proxmox\Helper\connection;

/**
 * Class vmid
 * @package proxmox\api\nodes\node\qemu
 */
class vmid
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * vmid constructor.
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
     * Qemu Agent command index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent
     * @return agent
     */
    public function agent(){
        return new agent($this->httpClient,$this->apiURL.'agent/',$this->cookie);
    }

    /**
     * -
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/cloudinit
     * @return cloudinit
     */
    public function cloudinit(){
        return new cloudinit($this->httpClient,$this->apiURL.'cloudinit/',$this->cookie);
    }

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/firewall
     * @return firewall
     */
    public function firewall(){
        return new firewall($this->httpClient,$this->apiURL.'firewall/',$this->cookie);
    }

    /**
     * List all snapshots.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/snapshot
     * @return snapshot
     */
    public function snapshot(){
        return new snapshot($this->httpClient,$this->apiURL.'snapshot/',$this->cookie);
    }

    /**
     * Directory index
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/status
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
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get the virtual machine configuration with pending configuration changes applied. Set the 'current' parameter to get the current configuration instead.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/config
     * @param $params array
     * @return mixed|null
     */
    public function getConfig($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'config/',$this->cookie,$params));
    }

    /**
     * Check if feature for virtual machine is available.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/feature
     * @param $params array
     * @return mixed|null
     */
    public function getFeature($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'feature/',$this->cookie,$params));
    }

    /**
     * Get preconditions for migration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/migrate
     * @param $params array
     * @return mixed|null
     */
    public function getMigrate($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'migrate/',$this->cookie,$params));
    }

    /**
     * Get the virtual machine configuration with both current and pending values.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/pending
     * @return mixed|null
     */
    public function getPending(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'pending/',$this->cookie));
    }

    /**
     * Read VM RRD statistics (returns PNG)
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/rrd
     * @param $params array
     * @return mixed|null
     */
    public function getRrd($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'rrd/',$this->cookie,$params));
    }

    /**
     * Read VM RRD statistics
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/rrddata
     * @param $params array
     * @return mixed|null
     */
    public function getRrdData($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'rrddata/',$this->cookie,$params));
    }

    /**
     * Opens a weksocket for VNC traffic.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/vncwebsocket
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
     * Set virtual machine options (asynchrounous API).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/config
     * @param $params array
     * @return mixed|null
     */
    public function postConfig($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'config/',$this->cookie,$params));
    }

    /**
     * Create a copy of virtual machine/template.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/clone
     * @param $params array
     * @return mixed|null
     */
    public function postClone($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'clone/',$this->cookie,$params));
    }

    /**
     * Migrate the container to another node. Creates a new migration task.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/migrate
     * @param $params array
     * @return mixed|null
     */
    public function postMigrate($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'migrate/',$this->cookie,$params));
    }

    /**
     * Execute Qemu monitor commands.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/monitor
     * @param $params array
     * @return mixed|null
     */
    public function postMonitor($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'monitor/',$this->cookie,$params));
    }

    /**
     * Move volume to different storage.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/move_disk
     * @param $params array
     * @return mixed|null
     */
    public function postMoveDisk($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'move_disk/',$this->cookie,$params));
    }

    /**
     * Returns a SPICE configuration to connect to the VM.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/spiceproxy
     * @param $params array
     * @return mixed|null
     */
    public function postSpiceProxy($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'spiceproxy/',$this->cookie,$params));
    }

    /**
     * Create a Template.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/template
     * @param $params array
     * @return mixed|null
     */
    public function postTemplate($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'template/',$this->cookie,$params));
    }

    /**
     * Creates a TCP proxy connections.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/termproxy
     * @param $params array
     * @return mixed|null
     */
    public function postTermProxy($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'termproxy/',$this->cookie,$params));
    }

    /**
     * Creates a TCP VNC proxy connections.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/vncproxy
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
     * Set virtual machine options (synchrounous API) - You should consider using the POST method instead for any actions involving hotplug or storage allocation.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/config
     * @param $params array
     * @return mixed|null
     */
    public function putConfig($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'config/',$this->cookie,$params));
    }

    /**
     * Extend volume size.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/resize
     * @param $params array
     * @return mixed|null
     */
    public function putResize($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'resize/',$this->cookie,$params));
    }

    /**
     * Send key event to virtual machine.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/sendkey
     * @param $params array
     * @return mixed|null
     */
    public function putSendkey($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'sendkey/',$this->cookie,$params));
    }

    /**
     * Unlink/delete disk images.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/unlink
     * @param $params array
     * @return mixed|null
     */
    public function putUnlink($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'unlink/',$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * Destroy the vm (also delete all used/owned volumes).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes
     * @param $params array
     * @return mixed
     */
    public function delete($params){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

}