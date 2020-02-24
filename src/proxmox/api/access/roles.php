<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\access;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class roles
 * @package proxmox\api\access
 */
class roles
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * roles constructor.
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
     * Role index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/roles
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get role configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/roles/{groupid}
     * @param $groupID string
     * @return mixed
     */
    public function getRoleid($groupID){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$groupID.'/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update an existing role.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/roles/{roleid}
     * @param $groupID string
     * @param $params array
     * @return mixed
     */
    public function putRoleid($groupID,$params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$groupID.'/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Create new role.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/roles
     * @return mixed
     */
    public function post(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * DELETE
     */

    /**
     * Delete role.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/roles/{roleid}
     * @param $groupID string
     * @param $params array
     * @return mixed
     */
    public function deleteRoleid($groupID,$params){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$groupID.'/',$this->cookie,$params));
    }

}