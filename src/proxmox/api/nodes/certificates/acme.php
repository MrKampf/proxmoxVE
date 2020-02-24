<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\certificates;


use GuzzleHttp\Client;
use proxmox\helper\connection;

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
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function postCertificate($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'certificate',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function putCertificate($param){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'certificate',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function deleteCertificate($param){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.'certificate',$this->cookie,$param));
    }
}