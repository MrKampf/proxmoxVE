<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\access;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class domains
 * @package proxmox\api\access
 */
class domains
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
     * Authentication domain index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get auth server configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains/{realm}
     * @param $realm string
     * @return mixed|null
     */
    public function getRealm($realm){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$realm.'/',$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Add an authentication server.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains
     * @param $params array
     * @return mixed
     */
    public function post($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

    /**
     * PUT
     */

    /**
     * Update authentication server settings.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains/{realm}
     * @param $realm string
     * @param $params array
     * @return mixed|null
     */
    public function putRealm($realm,$params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$realm.'/',$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * Delete an authentication server.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains/{realm}
     * @param $realm string
     * @return mixed|null
     */
    public function deleteRealm($realm){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$realm.'/',$this->cookie));
    }
}