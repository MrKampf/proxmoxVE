<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes;

use GuzzleHttp\Client;
use proxmox\api\nodes\lxc\firewall;
use proxmox\api\nodes\lxc\snapshot;
use proxmox\helper\connection;

/**
 * Class lxc
 * @package proxmox\api\nodes
 */
class lxc
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $apiURLWithVmid, //API url with vm id
        $CSRFPreventionToken, //CSRF token for auth
        $ticket, //Auth ticket
        $hostname, //Pormxox hostname
        $cookie; //Proxmox auth cookie

    /**
     * lxc constructor.
     * @param $httpClient Client
     * @param $apiURL string
     * @param $CSRFPreventionToken mixed
     * @param $ticket mixed
     * @param $hostname string
     * @param $cookie mixed
     * @param $vmid integer
     */
    public function __construct($httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname,$cookie,$vmid){
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL; //Save api url in class variable and change this to current api path
        $this->apiURLWithVmid = $apiURL.$vmid.'/'; //Save api url in class variable and change this to current api path
        $this->CSRFPreventionToken = $CSRFPreventionToken; //Save CSRF token in class variable
        $this->ticket = $ticket; //Save auth ticket in class variable
        $this->hostname = $hostname; //Save hostname in class variable
        $this->cookie = $cookie; //Save auth cookie in class variable
    }

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall
     * @return firewall
     */
    public function firewall(){
        return new firewall($this->httpClient,$this->apiURLWithVmid.'firewall/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * List all snapshots.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/snapshot
     * @return snapshot
     */
    public function snapshot(){
        return new snapshot($this->httpClient,$this->apiURLWithVmid.'snapshot/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
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
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,[]));
    }

    /**
     * Directory index
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}
     * @return mixed|null
     */
    public function getLxc(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURLWithVmid,$this->cookie,[]));
    }

    /**
     * Get container configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/config
     * @param $param array Params for api
     * @return mixed|null
     */
    public function getConfig($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURLWithVmid.'config/',$this->cookie,$param));
    }

    /**
     * Check if feature for virtual machine is available.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/feature
     * @param $param array Params for api
     * @return mixed|null
     */
    public function getFeature($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURLWithVmid.'feature/',$this->cookie,$param));
    }

    /**
     * Get container configuration, including pending changes.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/pending
     * @param $param array Params for api
     * @return mixed|null
     */
    public function getPending($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURLWithVmid.'pending/',$this->cookie,$param));
    }

    /**
     * Read VM RRD statistics (returns PNG)
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/rrd
     * @param $param array Params for api
     * @return mixed|null
     */
    public function getRrd($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURLWithVmid.'rrd/',$this->cookie,$param));
    }

    /**
     * Read VM RRD statistics
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/rrddata
     * @param $param array Params for api
     * @return mixed|null
     */
    public function getRrdData($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURLWithVmid.'rrddata/',$this->cookie,$param));
    }

    /**
     * Opens a weksocket for VNC traffic.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/vncwebsocket
     * @param $param array Params for api
     * @return mixed|null
     */
    public function getVncWebsocket($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURLWithVmid.'vncwebsocket/',$this->cookie,$param));
    }

    /**
     * POST
     */

    /**
     * Create a container clone/copy
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/clone
     * @param $param array Params for api
     * @return mixed|null
     */
    public function postClone($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURLWithVmid.'clone/',$this->cookie,$param));
    }

    /**
     * Migrate the container to another node. Creates a new migration task.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/migrate
     * @param $param array Params for api
     * @return mixed|null
     */
    public function postMigrate($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURLWithVmid.'migrate/',$this->cookie,$param));
    }

    /**
     * Move a rootfs-/mp-volume to a different storage
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/move_volume
     * @param $param array Params for api
     * @return mixed|null
     */
    public function postMoveVolume($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURLWithVmid.'move_volume/',$this->cookie,$param));
    }

    /**
     * Returns a SPICE configuration to connect to the CT.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/spiceproxy
     * @param $param array Params for api
     * @return mixed|null
     */
    public function postSpiceProxy($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURLWithVmid.'spiceproxy/',$this->cookie,$param));
    }

    /**
     * Create a Template.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/template
     * @param $param array Params for api
     * @return mixed|null
     */
    public function postTemplate($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURLWithVmid.'template/',$this->cookie,$param));
    }

    /**
     * Creates a TCP proxy connection.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/termproxy
     * @param $param array Params for api
     * @return mixed|null
     */
    public function postTermProxy($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURLWithVmid.'termproxy/',$this->cookie,$param));
    }

    /**
     * Creates a TCP VNC proxy connections.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/vncproxy
     * @param $param array Params for api
     * @return mixed|null
     */
    public function postVncProxy($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURLWithVmid.'vncproxy/',$this->cookie,$param));
    }

    /**
     * PUT
     */

    /**
     * Set container options.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/config
     * @param $param array Params for api
     * @return mixed|null
     */
    public function putConfig($param){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURLWithVmid.'config/',$this->cookie,$param));
    }

    /**
     * Resize a container mount point.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/resize
     * @param $param array Params for api
     * @return mixed|null
     */
    public function putResize($param){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURLWithVmid.'resize/',$this->cookie,$param));
    }

    /**
     * DELETE
     */

    /**
     * Directory index
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}
     * @return mixed|null
     */
    public function deleteLxc($vmid){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURLWithVmid,$this->cookie,[]));
    }
}