<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes\node\qemu\vmid;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class agent
 * @package proxmox\api\nodes\node\qemu\vmid
 */
class agent
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * agent constructor.
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
     * Qemu Agent command index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Gets the status of the given pid started by the guest-agent
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/exec-status
     * @param $params array
     * @return mixed
     */
    public function getExecStatus($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'exec-status/',$this->cookie,$params));
    }

    /**
     * Reads the given file via guest agent. Is limited to 16777216 bytes.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/file-read
     * @param $params array
     * @return mixed
     */
    public function getFileRead($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'file-read/',$this->cookie,$params));
    }

    /**
     * Execute get-host-name.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/get-host-name
     * @return mixed
     */
    public function getGetHostName(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'get-host-name/',$this->cookie));
    }

    /**
     * Execute get-memory-block-info.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/get-memory-block-info
     * @return mixed
     */
    public function getGetMemoryBlockInfo(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'get-memory-block-info/',$this->cookie));
    }

    /**
     * Execute get-memory-blocks.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/get-memory-blocks
     * @return mixed
     */
    public function getGetMemoryBlocks(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'get-memory-blocks/',$this->cookie));
    }

    /**
     * Execute get-osinfo.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/get-osinfo
     * @return mixed
     */
    public function getGetOsinfo(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'get-osinfo/',$this->cookie));
    }

    /**
     * Execute get-time.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/get-time
     * @return mixed
     */
    public function getGetTime(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'get-time/',$this->cookie));
    }

    /**
     * Execute get-timezone.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/get-timezone
     * @return mixed
     */
    public function getGetTimezone(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'get-timezone/',$this->cookie));
    }

    /**
     * Execute get-users.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/get-users
     * @return mixed
     */
    public function getGetUsers(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'get-users/',$this->cookie));
    }

    /**
     * Execute get-vcpus.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/get-vcpus
     * @return mixed
     */
    public function getGetVcpus(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'get-vcpus/',$this->cookie));
    }

    /**
     * Execute info.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/info
     * @return mixed
     */
    public function getInfo(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'info/',$this->cookie));
    }

    /**
     * Execute network-get-interfaces.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/network-get-interfaces
     * @return mixed
     */
    public function getNetworkGetInterfaces(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'network-get-interfaces/',$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Execute Qemu Guest Agent commands.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent
     * @param $params array
     * @return mixed
     */
    public function post($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

    /**
     * Executes the given command in the vm via the guest-agent and returns an object with the pid.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/exec
     * @param $params array
     * @return mixed
     */
    public function postExec($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'exec/',$this->cookie,$params));
    }

    /**
     * Writes the given file via guest agent.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/file-write
     * @param $params array
     * @return mixed
     */
    public function postFileWrite($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'file-write/',$this->cookie,$params));
    }

    /**
     * Execute fsfreeze-freeze.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/fsfreeze-freeze
     * @return mixed
     */
    public function postFsfreezeFreeze(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'fsfreeze-freeze/',$this->cookie));
    }

    /**
     * Execute fsfreeze-status.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/fsfreeze-status
     * @return mixed
     */
    public function postFsfreezeStatus(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'fsfreeze-status/',$this->cookie));
    }

    /**
     * Execute fsfreeze-thaw.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/fsfreeze-thaw
     * @return mixed
     */
    public function postFsfreezeThaw(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'fsfreeze-thaw/',$this->cookie));
    }

    /**
     * Execute fstrim.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/fstrim
     * @return mixed
     */
    public function postFstrim(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'fstrim/',$this->cookie));
    }

    /**
     * Execute ping.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/ping
     * @return mixed
     */
    public function postPing(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'ping/',$this->cookie));
    }

    /**
     * Sets the password for the given user to the given password
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/set-user-password
     * @param $params array
     * @return mixed
     */
    public function postSetUserPassword($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'set-user-password/',$this->cookie,$params));
    }

    /**
     * Execute shutdown.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/shutdown
     * @return mixed
     */
    public function postShutdown(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'shutdown/',$this->cookie));
    }

    /**
     * Execute suspend-disk.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/suspend-disk
     * @return mixed
     */
    public function postSuspendDisk(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'suspend-disk/',$this->cookie));
    }

    /**
     * Execute suspend-hybrid.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/suspend-hybrid
     * @return mixed
     */
    public function postSuspendHybrid(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'suspend-hybrid/',$this->cookie));
    }

    /**
     * Execute suspend-ram.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/agent/suspend-ram
     * @return mixed
     */
    public function postSuspendRam(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'suspend-ram/',$this->cookie));
    }

}