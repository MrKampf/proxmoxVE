<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api;

use proxmox\api\cluster\acme;
use proxmox\api\cluster\backup;
use proxmox\api\cluster\ceph;
use proxmox\api\cluster\config;
use proxmox\api\cluster\firewall;
use proxmox\api\cluster\ha;
use proxmox\api\cluster\replication;
use proxmox\helper\connection;

/**
 * Class cluster
 * @package proxmox\api
 */
class cluster
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $ticket, //Auth ticket
        $hostname, //Pormxox hostname
        $cookie; //Proxmox auth cookie

    /**
     * cluster constructor.
     * @param $httpClient
     * @param $apiURL
     * @param $ticket
     * @param $hostname
     */
    public function __construct($httpClient,$apiURL,$ticket,$hostname){
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL.'/api2/json/cluster/'; //Save api url in class variable and change this to current api path
        $this->ticket = $ticket; //Save auth ticket in class variable
        $this->hostname = $hostname; //Save hostname in class variable
        $this->cookie = connection::getCookies($this->ticket,$this->hostname); //Get auth cookie and save in class variable
    }

    /**
     * ACMEAccount index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme
     * @return acme
     */
    public function acme(){
        return new acme($this->httpClient,$this->apiURL.'acme/',$this->cookie);
    }

    /**
     * List vzdump backup schedule.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup
     * @return backup
     */
    public function backup(){
        return new backup($this->httpClient,$this->apiURL.'backup/',$this->cookie);
    }

    /**
     * Cluster ceph index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph
     * @return ceph
     */
    public function ceph(){
        return new ceph($this->httpClient,$this->apiURL.'ceph/',$this->cookie);
    }

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/config
     * @return config
     */
    public function config(){
        return new config($this->httpClient,$this->apiURL.'config/',$this->cookie);
    }

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall
     * @return firewall
     */
    public function firewall(){
        return new firewall($this->httpClient,$this->apiURL.'firewall/',$this->cookie);
    }

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha
     * @return ha
     */
    public function ha(){
        return new ha($this->httpClient,$this->apiURL.'ha/',$this->cookie);
    }

    /**
     * List replication jobs.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/replication
     * @return replication
     */
    public function replication(){
        return new replication($this->httpClient,$this->apiURL.'replication/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Cluster index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Read cluster log
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/log
     * @param $params array
     * @return mixed
     */
    public function getLog($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'log/',$this->cookie,$params));
    }

    /**
     * Get next free VMID. If you pass an VMID it will raise an error if the ID is already used.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/nextid
     * @param $params array
     * @return mixed
     */
    public function getNextid($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'nextid/',$this->cookie,$params));
    }

    /**
     * Resources index (cluster wide).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/resources
     * @param $params array
     * @return mixed
     */
    public function getResources($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'resources/',$this->cookie,$params));
    }

    /**
     * Get datacenter options.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/options
     * @return mixed
     */
    public function getOptions(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'options/',$this->cookie));
    }

    /**
     * Get cluster status information.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/status
     * @return mixed
     */
    public function getStatus(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'status/',$this->cookie));
    }

    /**
     * List recent tasks (cluster wide).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/tasks
     * @return mixed
     */
    public function getTasks(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'tasks/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Set datacenter options.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/options
     * @param $params array
     * @return mixed
     */
    public function putOptions($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'options/',$this->cookie,$params));
    }

}