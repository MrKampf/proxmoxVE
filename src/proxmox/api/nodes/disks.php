<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes;


use proxmox\api\nodes\disks\zfs;
use proxmox\helper\connection;

class disks
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