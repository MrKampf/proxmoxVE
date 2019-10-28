<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\lxc;


use proxmox\helper\connection;

class firewall
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
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,[]));
    }

    /**
     * @return aliases
     */
    public function aliases(){
        return new aliases($this->httpClient,$this->apiURL.'/aliases/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * @return mixed|null
     */
    public function getLog(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'log',$this->cookie,[]));
    }

    /**
     * @return mixed|null
     */
    public function getOptions(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'options',$this->cookie,[]));
    }

    /**
     * @return mixed|null
     */
    public function getRefs(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'refs',$this->cookie,[]));
    }

    /**
     * @param $param
     * @return mixed|null
     */
    public function postOptions($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'options',$this->cookie,$param));
    }
}