<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\Access\users\userid;

use GuzzleHttp\Client;

/**
 * Class token
 * @package proxmox\api\access\users\userid
 */
class token
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * domains constructor.
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
     * Get user API tokens.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users/{userid}/token
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get specific API token information.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users/{userid}/token/{tokenid}
     * @param $tokenID string
     * @return mixed
     */
    public function getTokenid($tokenID){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$tokenID.'/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update API token for a specific user.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users/{userid}/token/{tokenid}
     * @param $tokenID string
     * @param $params array
     * @return mixed
     */
    public function putTokenid($tokenID,$params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$tokenID.'/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Generate a new API token for a specific user. NOTE: returns API token value, which needs to be stored as it cannot be retrieved afterwards!
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users/{userid}/token/{tokenid}
     * @param $tokenID string
     * @param $params array
     * @return mixed
     */
    public function postTokenid($tokenID,$params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$tokenID.'/',$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * Remove API token for a specific user.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users/{userid}/token/{tokenid}
     * @param $tokenID string
     * @return mixed
     */
    public function deleteTokenid($tokenID){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$tokenID.'/',$this->cookie));
    }

}