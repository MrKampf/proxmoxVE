<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\cluster;

use GuzzleHttp\Client;
use proxmox\api\cluster\ceph\flags;
use proxmox\helper\connection;

/**
 * Class ceph
 * @package proxmox\api\cluster
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
     * get the status of all ceph flags
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/flags
     * @return flags
     */
    public function flags(){
        return new flags($this->httpClient,$this->apiURL.'flags/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Cluster ceph index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get ceph metadata.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/metadata
     * @return mixed
     */
    public function getMetadata(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'metadata/',$this->cookie));
    }

    /**
     * Get ceph status.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/status
     * @return mixed
     */
    public function getStatus(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'status/',$this->cookie));
    }

}