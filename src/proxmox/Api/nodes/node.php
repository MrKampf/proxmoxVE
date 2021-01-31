<?php
/*
 * @copyright  2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes;

use GuzzleHttp\Client;
use proxmox\Api\nodes\node\apt;
use proxmox\Api\nodes\node\ceph;
use proxmox\Api\nodes\node\certificates;
use proxmox\Api\nodes\node\disks;
use proxmox\Api\nodes\node\firewall;
use proxmox\Api\nodes\node\hardware;
use proxmox\Api\nodes\node\lxc;
use proxmox\Api\nodes\node\network;
use proxmox\Api\nodes\node\qemu;
use proxmox\Api\nodes\node\storage;
use proxmox\Api\nodes\node\vzdump;
use proxmox\Helper\connection;

/**
 * Class node
 * @package proxmox\api\nodes
 */
class node
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * node constructor.
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
     * Directory index for apt (Advanced Package Tool).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/apt
     * @return apt
     */
    public function apt(){
        return new apt($this->httpClient,$this->apiURL.'apt/',$this->cookie);
    }

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph
     * @return ceph
     */
    public function ceph(){
        return new ceph($this->httpClient,$this->apiURL.'ceph/',$this->cookie);
    }

    /**
     * Node index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/certificates
     * @return certificates
     */
    public function certificates(){
        return new certificates($this->httpClient,$this->apiURL.'certificates/',$this->cookie);
    }

    /**
     * Node index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks
     * @return disks
     */
    public function disks(){
        return new disks($this->httpClient,$this->apiURL.'disks/',$this->cookie);
    }

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/firewall
     * @return firewall
     */
    public function firewall(){
        return new firewall($this->httpClient,$this->apiURL.'firewall/',$this->cookie);
    }

    /**
     * Index of hardware types
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/hardware
     * @return hardware
     */
    public function hardware(){
        return new hardware($this->httpClient,$this->apiURL.'hardware/',$this->cookie);
    }

    /**
     * LXC container index (per node).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc
     * @return lxc
     */
    public function lxc(){
        return new lxc($this->httpClient,$this->apiURL.'lxc/',$this->cookie);
    }

    /**
     * List available networks
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/network
     * @return network
     */
    public function network(){
        return new network($this->httpClient,$this->apiURL.'network/',$this->cookie);
    }

    /**
     * Virtual machine index (per node).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu
     * @return qemu
     */
    public function qemu(){
        return new qemu($this->httpClient,$this->apiURL.'qemu/',$this->cookie);
    }

    /**
     * Virtual machine index (per node).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/storage
     * @return storage
     */
    public function storage(){
        return new storage($this->httpClient,$this->apiURL.'storage/',$this->cookie);
    }

    /**
     * Create backup.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/vzdump
     * @return vzdump
     */
    public function vzdump(){
        return new vzdump($this->httpClient,$this->apiURL.'vzdump/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Node index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get list of appliances.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/aplinfo
     * @return mixed
     */
    public function getAplinfo(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'aplinfo/',$this->cookie));
    }

    /**
     * Get node configuration options.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/config
     * @param $params array
     * @return mixed
     */
    public function getConfig($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'config/',$this->cookie,$params));
    }

    /**
     * Read DNS settings.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/dns
     * @return mixed
     */
    public function getDNS(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'dns/',$this->cookie));
    }

    /**
     * Get the content of /etc/hosts.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/hosts
     * @return mixed
     */
    public function getHosts(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'hosts/',$this->cookie));
    }

    /**
     * Read Journal
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/journal
     * @param $param
     * @return mixed
     */
    public function getJournal($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'journal/',$this->cookie,$param));
    }

    /**
     * Read tap/vm network device interface counters
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/netstat
     * @return mixed
     */
    public function getNetstat(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'netstat/',$this->cookie));
    }

    /**
     * Gather various systems information about a node
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/report
     * @return mixed
     */
    public function getReport(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'report/',$this->cookie));
    }

    /**
     * Read node RRD statistics (returns PNG)
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/rrd
     * @param $params array
     * @return mixed
     */
    public function getRrd($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'rrd/',$this->cookie,$params));
    }

    /**
     * Read node RRD statistics
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/rrddata
     * @param $params array
     * @return mixed
     */
    public function getRrddata($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'rrddata/',$this->cookie,$params));
    }

    /**
     * Read node status
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/status
     * @return mixed
     */
    public function getStatus(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'status/',$this->cookie));
    }

    /**
     * Read subscription info.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/subscription
     * @return mixed
     */
    public function getSubscription(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'subscription/',$this->cookie));
    }

    /**
     * Read system log
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/syslog
     * @param $params array
     * @return mixed
     */
    public function getSyslog($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'syslog/',$this->cookie,$params));
    }

    /**
     * Read server time and time zone settings.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/time
     * @return mixed
     */
    public function getTime(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'time/',$this->cookie));
    }

    /**
     * API version details
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/version
     * @return mixed
     */
    public function getVersion(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'version/',$this->cookie));
    }

    /**
     * Opens a weksocket for VNC traffic.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/vncwebsocket
     * @param $params array
     * @return mixed
     */
    public function getVncwebsocket($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'vncwebsocket/',$this->cookie,$params));
    }

    /**
     * PUT
     */

    /**
     * Set node configuration options.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/config
     * @param $params array
     * @return mixed
     */
    public function putConfig($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'config/',$this->cookie,$params));
    }

    /**
     * Write DNS settings.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/config
     * @param $params array
     * @return mixed
     */
    public function putDns($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'dns/',$this->cookie,$params));
    }

    /**
     * Set subscription key.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/subscription
     * @param $params array
     * @return mixed
     */
    public function putSubscription($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'subscription/',$this->cookie,$params));
    }

    /**
     * Set time zone.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/time
     * @param $params array
     * @return mixed
     */
    public function putTime($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'time/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Write /etc/hosts.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/hosts
     * @param $params array
     * @return mixed
     */
    public function postHosts($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'hosts/',$this->cookie,$params));
    }

    /**
     * Migrate all VMs and Containers.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/migrateall
     * @param $params array
     * @return mixed
     */
    public function postMigrateall($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'migrateall/',$this->cookie,$params));
    }

    /**
     * Creates a SPICE shell.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/spiceshell
     * @param $params array
     * @return mixed
     */
    public function postSpiceshell($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'spiceshell/',$this->cookie,$params));
    }

    /**
     * Start all VMs and containers located on this node (by default only those with onboot=1).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/startall
     * @param $params array
     * @return mixed
     */
    public function postStartall($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'startall/',$this->cookie,$params));
    }

    /**
     * Reboot or shutdown a node.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/status
     * @param $params array
     * @return mixed
     */
    public function postStatus($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'status/',$this->cookie,$params));
    }

    /**
     * Stop all VMs and Containers.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/stopall
     * @param $params array
     * @return mixed
     */
    public function postStopall($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'stopall/',$this->cookie,$params));
    }

    /**
     * Update subscription info.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/subscription
     * @param $params array
     * @return mixed
     */
    public function postSubscription($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'subscription/',$this->cookie,$params));
    }

    /**
     * Creates a VNC Shell proxy.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/termproxy
     * @param $params array
     * @return mixed
     */
    public function postTermproxy($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'termproxy/',$this->cookie,$params));
    }

    /**
     * Creates a VNC Shell proxy.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/vncshell
     * @param $params array
     * @return mixed
     */
    public function postVncshell($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'vncshell/',$this->cookie,$params));
    }

    /**
     * Try to wake a node via 'wake on LAN' network packet.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/wakeonlan
     * @return mixed
     */
    public function postWakeonlan(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'wakeonlan/',$this->cookie));
    }

}