<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes;

use proxmox\api\nodes\lxc\firewall;
use proxmox\helper\connection;

class lxc
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $CSRFPreventionToken, //CSRF token for auth
        $ticket, //Auth ticket
        $hostname, //Pormxox hostname
        $cookie; //Proxmox auth cookie

    /**
     * lxc constructor.
     * @param $httpClient
     * @param $apiURL
     * @param $CSRFPreventionToken
     * @param $ticket
     * @param $hostname
     * @param $cookie
     */
    public function __construct($httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname,$cookie){
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL.'lxc/'; //Save api url in class variable and change this to current api path
        $this->CSRFPreventionToken = $CSRFPreventionToken; //Save CSRF token in class variable
        $this->ticket = $ticket; //Save auth ticket in class variable
        $this->hostname = $hostname; //Save hostname in class variable
        $this->cookie = $cookie; //Save auth cookie in class variable
    }

    /**
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,[]));
    }

    /**
     * @return firewall
     */
    public function firewall(){
        return new firewall($this->httpClient,$this->apiURL.'/firewall/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * @param $vmid
     * @return mixed|null
     */
    public function getLxc($vmid){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$vmid,$this->cookie,[]));
    }

    /**
     * @param $vmid
     * @param $param
     * @return mixed|null
     */
    public function getConfig($vmid,$param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$vmid.'/config/',$this->cookie,$param));
    }

    /**
     * @param $vmid
     * @param $param
     * @return mixed|null
     */
    public function getFeature($vmid,$param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$vmid.'/feature/',$this->cookie,$param));
    }

    /**
     * @param $vmid
     * @param $param
     * @return mixed|null
     */
    public function postClone($vmid,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$vmid.'/clone/',$this->cookie,$param));
    }

    /**
     * @param $vmid
     * @param $param
     * @return mixed|null
     */
    public function postMigrate($vmid,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$vmid.'/migrate/',$this->cookie,$param));
    }

    /**
     * @param $vmid
     * @param $param
     * @return mixed|null
     */
    public function putConfig($vmid,$param){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$vmid.'/config/',$this->cookie,$param));
    }

    /**
     * @param $vmid
     * @return mixed|null
     */
    public function deleteLxc($vmid){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$vmid,$this->cookie,[]));
    }
}