<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class version
 * @package proxmox\api
 */
class storage
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $ticket, //Auth ticket
        $hostname, //Pormxox hostname
        $cookie; //Proxmox auth cookie

    /**
     * version constructor.
     * @param $httpClient Client
     * @param $apiURL string
     * @param $ticket string
     * @param $hostname string
     */
    public function __construct($httpClient,$apiURL,$ticket,$hostname){
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL.'/api2/json/storage/'; //Save api url in class variable and change this to current api path
        $this->ticket = $ticket; //Save auth ticket in class variable
        $this->hostname = $hostname; //Save hostname in class variable
        $this->cookie = connection::getCookies($this->ticket,$this->hostname); //Get auth cookie and save in class variable
    }

    /**
     * GET
     */

    /**
     * Storage index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Read storage configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage/{storage}
     * @param $storage string
     * @return mixed
     */
    public function getStorage($storage){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$storage.'/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update storage configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage/{storage}
     * @param $storage string
     * @param $params array
     * @return mixed
     */
    public function putStorage($storage,$params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$storage.'/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Create a new storage.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage
     * @return mixed
     */
    public function post(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * DELETE
     */

    /**
     * Delete storage configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage/{storage}
     * @param $storage string
     * @return mixed
     */
    public function deleteStorage($storage){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$storage.'/',$this->cookie));
    }
}