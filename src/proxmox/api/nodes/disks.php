<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes;

use proxmox\api\nodes\disks\zfs;
use proxmox\helper\connection;

/**
 * Class disks
 * @package proxmox\api\nodes
 */
class disks
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $CSRFPreventionToken, //CSRF token for auth
        $ticket, //Auth ticket
        $hostname, //Pormxox hostname
        $cookie; //Proxmox auth cookie

    /**
     * disks constructor.
     * @param $httpClient
     * @param $apiURL
     * @param $CSRFPreventionToken
     * @param $ticket
     * @param $hostname
     * @param $cookie
     */
    public function __construct($httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname,$cookie){
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL; //Save api url in class variable and change this to current api path
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
     * @return zfs
     */
    public function zfs(){
        return new zfs($this->httpClient,$this->apiURL.'/zfs/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * @return mixed
     */
    public function getDirectory(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'directory',$this->cookie,[]));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getList($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'list',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getLvm($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'lvm',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getLvmThin($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'lvmthin',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getSmart($param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'smart',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function postDirectory($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'directory',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function postInitgpt($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'initgpt',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function postLvm($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'lvm',$this->cookie,$param));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function postLvmThin($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'lvmthin',$this->cookie,$param));
    }
}