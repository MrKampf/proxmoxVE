<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class pools
 * @package proxmox\api
 */
class pools
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $ticket, //Auth ticket
        $hostname, //Pormxox hostname
        $cookie; //Proxmox auth cookie

    /**
     * pools constructor.
     * @param $httpClient Client
     * @param $apiURL string
     * @param $ticket string
     * @param $hostname string
     */
    public function __construct($httpClient,$apiURL,$ticket,$hostname){
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL.'/api2/json/pools/'; //Save api url in class variable and change this to current api path
        $this->ticket = $ticket; //Save auth ticket in class variable
        $this->hostname = $hostname; //Save hostname in class variable
        $this->cookie = connection::getCookies($this->ticket,$this->hostname); //Get auth cookie and save in class variable
    }

    /**
     * GET
     */

    /**
     * Pool index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get pool configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools/{poolid}
     * @param $poolId string
     * @return mixed
     */
    public function getPoolid($poolId){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$poolId.'/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update pool data.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools/{poolid}
     * @param $poolId string
     * @param $params array
     * @return mixed
     */
    public function putPoolid($poolId,$params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$poolId.'/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Create new pool.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools
     * @return mixed
     */
    public function post(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * DELETE
     */

    /**
     * Delete pool.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools/{poolid}
     * @param $poolId string
     * @return mixed
     */
    public function deletePoolid($poolId){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$poolId.'/',$this->cookie));
    }
}