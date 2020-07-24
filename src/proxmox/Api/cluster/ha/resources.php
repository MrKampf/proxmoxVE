<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\cluster\ha;

use GuzzleHttp\Client;
use proxmox\Api\cluster\ha\resources\sid;
use proxmox\Helper\connection;

/**
 * Class resources
 * @package proxmox\api\cluster\ha
 */
class resources
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * resources constructor.
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
     * Read resource configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/resources/{sid}
     * @param $sid
     * @return sid
     */
    public function sid($sid){
        return new sid($this->httpClient,$this->apiURL.$sid.'/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * List HA resources.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/resources
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Create a new HA resource.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/resources
     * @param $params array
     * @return mixed|null
     */
    public function post($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

}