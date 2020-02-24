<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\cluster\ha;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class groups
 * @package proxmox\api\cluster\ha
 */
class groups
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * groups constructor.
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
     * Get HA groups.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/groups
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Read ha group configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/groups/{group}
     * @param $group string
     * @return mixed|null
     */
    public function getGroup($group){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$group.'/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update ha group configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/groups/{group}
     * @param $group string
     * @param $param array
     * @return mixed|null
     */
    public function putGroup($group,$param){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$group.'/',$this->cookie,$param));
    }

    /**
     * POST
     */

    /**
     * Create a new HA group.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/groups
     * @param $param array
     * @return mixed|null
     */
    public function post($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$param));
    }

    /**
     * DELETE
     */

    /**
     * Delete ha group configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ha/groups/{group}
     * @param $group string
     * @return mixed|null
     */
    public function deleteGroup($group){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$group.'/',$this->cookie));
    }

}