<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\cluster;

use GuzzleHttp\Client;
use proxmox\Api\cluster\firewall\groups\group;
use proxmox\Api\cluster\ha\resources;
use proxmox\Api\cluster\ha\status;
use proxmox\Helper\connection;

/**
 * Class ha
 * @package proxmox\api\cluster
 */
class ha
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * ha constructor.
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
     * Get HA groups.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/groups
     * @return group
     */
    public function groups(){
        return new group($this->httpClient,$this->apiURL.'groups/',$this->cookie);
    }

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/status
     * @return status
     */
    public function status(){
        return new status($this->httpClient,$this->apiURL.'status/',$this->cookie);
    }

    /**
     * List HA resources.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/resources
     * @return resources
     */
    public function resources(){
        return new resources($this->httpClient,$this->apiURL.'resources/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

}