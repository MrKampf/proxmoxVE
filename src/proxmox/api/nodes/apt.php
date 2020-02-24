<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class apt
 * @package proxmox\api\nodes
 */
class apt
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * apt constructor.
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
     * @param $param
     * @return mixed
     */
    public function getChangelog($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'changelog',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getUpdate($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'update',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getVersion($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'version',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function postUpdate($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'update',$this->cookie,$param));
    }
}