<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\cluster\acme;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class account
 * @package proxmox\api\cluster\acme
 */
class account
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * account constructor.
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
     * ACMEAccount index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Return existing ACME account information.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account/{name}
     * @param $name string
     * @return mixed
     */
    public function getName($name){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$name.'/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update existing ACME account information with CA. Note: not specifying any new account information triggers a refresh.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account/{name}
     * @param $name string
     * @param $params array
     * @return mixed
     */
    public function putName($name,$params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$name.'/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * ACMEAccount index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme
     * @return mixed
     */
    public function post(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Deactivate existing ACME account at CA.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account/{name}
     * @param $name string
     * @return mixed
     */
    public function deleteName($name){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$name.'/',$this->cookie));
    }

}