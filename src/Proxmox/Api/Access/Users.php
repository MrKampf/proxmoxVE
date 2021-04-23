<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace Proxmox\Api\access;

use GuzzleHttp\Client;
use Proxmox\Api\access\users\userid;
use Proxmox\Helper\connection;

/**
 * Class users
 * @package proxmox\api\access
 */
class users
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * users constructor.
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
     * Get user configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users/{userid}
     * @param $userID
     * @return userid
     */
    public function userid($userID){
        return new userid($this->httpClient,$this->apiURL.$userID.'/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Authentication domain index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users
     * @param $params array
     * @return mixed
     */
    public function get($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Add an authentication server.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users
     * @param $params array
     * @return mixed
     */
    public function post($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }
}