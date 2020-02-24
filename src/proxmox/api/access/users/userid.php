<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\access\users;

use GuzzleHttp\Client;
use proxmox\api\access\users\userid\token;
use proxmox\helper\connection;

/**
 * Class userid
 * @package proxmox\api\access\users
 */
class userid
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * userid constructor.
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
     * Get user API tokens.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users/{userid}/token
     * @return token
     */
    public function token(){
        return new token($this->httpClient,$this->apiURL,$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Get user configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users/{userid}
     * @param $params array
     * @return mixed
     */
    public function get($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

    /**
     * Get user TFA types (Personal and Realm).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users/{userid}/tfa
     * @return mixed
     */
    public function getTfa(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'tfa/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update user configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users/{userid}
     * @param $params array
     * @return mixed
     */
    public function put($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * Delete user.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users/{userid}
     * @return mixed
     */
    public function delete(){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

}