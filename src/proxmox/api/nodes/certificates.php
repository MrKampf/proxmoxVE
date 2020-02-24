<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes;

use GuzzleHttp\Client;
use proxmox\api\nodes\certificates\acme;
use proxmox\helper\connection;

/**
 * Class certificates
 * @package proxmox\api\nodes
 */
class certificates
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * certificates constructor.
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
     * @return acme
     */
    public function Acme(){
        return new acme($this->httpClient,$this->apiURL.'/acme/',$this->cookie);
    }

    /**
     * @return mixed
     */
    public function getInfo(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'info',$this->cookie));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function postCustom($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'acme',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function deleteCustom($param){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.'acme',$this->cookie,$param));
    }
}