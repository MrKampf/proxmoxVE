<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\cluster\ha;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class status
 * @package proxmox\api\cluster\ha
 */
class status
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * status constructor.
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
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/status
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get full HA manger status, including LRM status.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/status/manager_status
     * @return mixed|null
     */
    public function getManagerStatus(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'manager_status/',$this->cookie));
    }

}