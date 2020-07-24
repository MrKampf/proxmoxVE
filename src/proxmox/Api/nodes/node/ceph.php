<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes\node;

use GuzzleHttp\Client;
use proxmox\Api\nodes\node\ceph\flags;
use proxmox\Api\nodes\node\ceph\fs;
use proxmox\Api\nodes\node\ceph\mds;
use proxmox\Api\nodes\node\ceph\mgr;
use proxmox\Api\nodes\node\ceph\mon;
use proxmox\Api\nodes\node\ceph\osd;
use proxmox\Api\nodes\node\ceph\pools;
use proxmox\Helper\connection;

/**
 * Class ceph
 * @package proxmox\api\nodes\node
 */
class ceph
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * ceph constructor.
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
     * get all set ceph flags
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/flags
     * @return flags
     */
    public function flags(){
        return new flags($this->httpClient,$this->apiURL.'flags/',$this->cookie);
    }

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/fs
     * @return fs
     */
    public function fs(){
        return new fs($this->httpClient,$this->apiURL.'fs/',$this->cookie);
    }

    /**
     * Create Ceph Metadata Server (MDS)
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/mds
     * @return mds
     */
    public function mds(){
        return new mds($this->httpClient,$this->apiURL.'mds/',$this->cookie);
    }

    /**
     * MGR directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/mgr
     * @return mgr
     */
    public function mgr(){
        return new mgr($this->httpClient,$this->apiURL.'mgr/',$this->cookie);
    }

    /**
     * Get Ceph monitor list.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/mon
     * @return mon
     */
    public function mon(){
        return new mon($this->httpClient,$this->apiURL.'mon/',$this->cookie);
    }

    /**
     * Get Ceph osd list/tree.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/osd
     * @return osd
     */
    public function osd(){
        return new osd($this->httpClient,$this->apiURL.'osd/',$this->cookie);
    }

    /**
     * List all pools.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/pools
     * @return pools
     */
    public function pools(){
        return new pools($this->httpClient,$this->apiURL.'pools/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get Ceph configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/config
     * @return mixed
     */
    public function getConfig(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'config/',$this->cookie));
    }

    /**
     * Get Ceph configuration database.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/configdb
     * @return mixed
     */
    public function getConfigDB(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'configdb/',$this->cookie));
    }

    /**
     * Get OSD crush map
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/crush
     * @return mixed
     */
    public function getCrush(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'crush/',$this->cookie));
    }

    /**
     * List local disks.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/disks
     * @param $params array
     * @return mixed
     */
    public function getDisks($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'disks/',$this->cookie,$params));
    }

    /**
     * Read ceph log
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/log
     * @param $params array
     * @return mixed
     */
    public function getLog($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'log/',$this->cookie,$params));
    }

    /**
     * List ceph rules.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/rules
     * @return mixed
     */
    public function getRules(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'rules/',$this->cookie));
    }

    /**
     * Get ceph status.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/status
     * @return mixed
     */
    public function getStatus(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'status/',$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Create initial ceph default configuration and setup symlinks.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/init
     * @param $param
     * @return mixed
     */
    public function postInit($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'init/',$this->cookie,$param));
    }

    /**
     * Restart ceph services.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/restart
     * @param $param
     * @return mixed
     */
    public function postRestart($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'restart/',$this->cookie,$param));
    }

    /**
     * Start ceph services.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/start
     * @param $param
     * @return mixed
     */
    public function postStart($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'start/',$this->cookie,$param));
    }

    /**
     * Stop ceph services.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/stop
     * @param $param
     * @return mixed
     */
    public function postStop($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'stop/',$this->cookie,$param));
    }
}