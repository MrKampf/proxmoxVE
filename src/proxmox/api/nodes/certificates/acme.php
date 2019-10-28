<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\certificates;


use proxmox\helper\connection;

class acme
{
    private $httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname,$cookie;

    public function __construct($httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname,$cookie){
        $this->httpClient = $httpClient;
        $this->apiURL = $apiURL;
        $this->CSRFPreventionToken = $CSRFPreventionToken;
        $this->ticket = $ticket;
        $this->hostname = $hostname;
        $this->cookie = $cookie;
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