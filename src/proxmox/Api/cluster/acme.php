<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\cluster;

use GuzzleHttp\Client;
use proxmox\Api\cluster\acme\account;
use proxmox\Helper\connection;

/**
 * Class acme
 * @package proxmox\api\cluster
 */
class acme
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * acme constructor.
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
     * ACMEAccount index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account
     * @return account
     */
    public function account(){
        return new account($this->httpClient,$this->apiURL.'account/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * ACMEAccount index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get named known ACME directory endpoints.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/directories
     * @return mixed
     */
    public function getDirectories(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'directories/',$this->cookie));
    }

    /**
     * Retrieve ACME TermsOfService URL from CA.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/tos
     * @param $params array
     * @return mixed
     */
    public function getTos($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'tos/',$this->cookie,$params));
    }

}