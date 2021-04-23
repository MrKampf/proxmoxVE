<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace Proxmox\Api\Access;

use GuzzleHttp\Client;
use Proxmox\Helper\connection;

/**
 * Class groups
 * @package proxmox\api\access
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
     * Group index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get group configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups/{groupid}
     * @param $groupID string
     * @return mixed
     */
    public function getGroupID($groupID){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$groupID.'/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update group data.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups/{groupid}
     * @param $groupID string
     * @param $params array
     * @return mixed
     */
    public function putGroupID($groupID,$params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$groupID.'/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Create new group.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups
     * @return mixed
     */
    public function post(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * DELETE
     */

    /**
     * Delete group.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups/{groupid}
     * @param $groupID string
     * @param $params array
     * @return mixed
     */
    public function deleteGroupID($groupID,$params){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$groupID.'/',$this->cookie,$params));
    }

}