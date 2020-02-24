<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\node;

use GuzzleHttp\Client;
use proxmox\api\nodes\node\disks\zfs;
use proxmox\helper\connection;

/**
 * Class disks
 * @package proxmox\api\nodes\node
 */
class disks
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * disks constructor.
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
     * List Zpools.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks/zfs
     * @return zfs
     */
    public function zfs(){
        return new zfs($this->httpClient,$this->apiURL.'zfs/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Node index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * PVE Managed Directory storages.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks/directory
     * @return mixed
     */
    public function getDirectory(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'directory/',$this->cookie));
    }

    /**
     * List local disks.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks/list
     * @param $params array
     * @return mixed
     */
    public function getList($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'list/',$this->cookie,$params));
    }

    /**
     * List LVM Volume Groups
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks/lvm
     * @return mixed
     */
    public function getLvm(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'lvm/',$this->cookie));
    }

    /**
     * List LVM thinpools
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks/lvmthin
     * @return mixed
     */
    public function getLvmThin(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'lvmthin/',$this->cookie));
    }

    /**
     * Get SMART Health of a disk.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks/smart
     * @param $params array
     * @return mixed
     */
    public function getSmart($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'smart/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Create a Filesystem on an unused disk. Will be mounted under '/mnt/pve/NAME'.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks/directory
     * @param $params array
     * @return mixed
     */
    public function postDirectory($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'directory/',$this->cookie,$params));
    }

    /**
     * Initialize Disk with GPT
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks/initgpt
     * @param $params array
     * @return mixed
     */
    public function postInitgpt($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'initgpt/',$this->cookie,$params));
    }

    /**
     * Create an LVM Volume Group
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks/lvm
     * @param $params array
     * @return mixed
     */
    public function postLvm($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'lvm/',$this->cookie,$params));
    }

    /**
     * Create an LVM thinpool
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks/lvmthin
     * @param $params array
     * @return mixed
     */
    public function postLvmThin($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'lvmthin/',$this->cookie,$params));
    }
}