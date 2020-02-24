<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\ceph;


use GuzzleHttp\Client;
use proxmox\helper\connection;

class flags
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * flags constructor.
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
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * @param $flag
     * @return mixed
     */
    public function postFlag($flag){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$flag,$this->cookie));
    }

    /**
     * @param $flag
     * @return mixed
     */
    public function deleteFlag($flag){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$flag,$this->cookie));
    }
}