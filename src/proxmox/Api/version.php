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
class version
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
        $this->apiURL = $apiURL.'/api2/json/version/'; //Save api url in class variable and change this to current api path
        $this->ticket = $ticket; //Save auth ticket in class variable
        $this->hostname = $hostname; //Save hostname in class variable
        $this->cookie = connection::getCookies($this->ticket,$this->hostname); //Get auth cookie and save in class variable
    }

    /**
     * GET
     */

    /**
     * API version details. The result also includes the global datacenter confguration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/version
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }
}