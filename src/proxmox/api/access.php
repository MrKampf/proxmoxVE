<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api;

use proxmox\api\access\domains;
use proxmox\helper\connection;

/**
 * Class access
 * @package proxmox\api
 */
class access
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $CSRFPreventionToken, //CSRF token for auth
        $ticket, //Auth ticket
        $hostname, //Pormxox hostname
        $cookie; //Proxmox auth cookie

    /**
     * access constructor.
     * @param $httpClient
     * @param $apiURL
     * @param $CSRFPreventionToken
     * @param $ticket
     * @param $hostname
     */
    public function __construct($httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname){
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL.'/api2/json/access/'; //Save api url in class variable and change this to current api path
        $this->CSRFPreventionToken = $CSRFPreventionToken; //Save CSRF token in class variable
        $this->ticket = $ticket; //Save auth ticket in class variable
        $this->hostname = $hostname; //Save hostname in class variable
        $this->cookie = connection::getCookies($this->ticket,$this->hostname); //Get auth cookie and save in class variable
    }

    /**
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,[]));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function post($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$param));
    }

    /**
     * @return domains
     */
    public function domains(){
        return new domains($this->httpClient,$this->apiURL.'/domains/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }
}