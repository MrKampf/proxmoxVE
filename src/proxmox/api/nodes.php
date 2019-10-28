<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api;

use proxmox\api\nodes\apt;
use proxmox\api\nodes\ceph;
use proxmox\api\nodes\certificates;
use proxmox\api\nodes\disks;
use proxmox\helper\connection;

class nodes
{
    private $httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname,$cookie;

    public function __construct($httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname){
        $this->httpClient = $httpClient;
        $this->apiURL = $apiURL.'/api2/json/nodes/';
        $this->CSRFPreventionToken = $CSRFPreventionToken;
        $this->ticket = $ticket;
        $this->hostname = $hostname;
        $this->cookie = connection::getCookies($this->ticket,$this->hostname);
    }

    /**
     * @param $node
     * @return apt
     */
    public function apt($node){
        return new apt($this->httpClient,$this->apiURL.$node.'/apt/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * @param $node
     * @return ceph
     */
    public function ceph($node){
        return new ceph($this->httpClient,$this->apiURL.$node.'/ceph/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * @param $node
     * @return certificates
     */
    public function certificates($node){
        return new certificates($this->httpClient,$this->apiURL.$node.'/certificates/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * @param $node
     * @return disks
     */
    public function disks($node){
        return new disks($this->httpClient,$this->apiURL.$node.'/disks/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * @param $node
     * @return lxc
     */
    public function lxc($node){
        return new lxc($this->httpClient,$this->apiURL.$node.'/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * @param $node
     * @return qemu
     */
    public function qemu($node){
        return new qemu($this->httpClient,$this->apiURL.$node.'/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,[]));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function getNode($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/status',$this->cookie,[]));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function getLxc($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/lxc',$this->cookie,[]));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function getAplinfo($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/aplinfo',$this->cookie,[]));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function getConfig($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/config',$this->cookie,[]));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function getDNS($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/dns',$this->cookie,[]));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function getHosts($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/hosts',$this->cookie,[]));
    }

    /**
     * @param $node
     * @param $param
     * @return mixed
     */
    public function getJournal($node,$param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/journal',$this->cookie,$param));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function getNetstat($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/netstat',$this->cookie,[]));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function getReport($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/report',$this->cookie,[]));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function getRrd($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/rrd',$this->cookie,[]));
    }

    /**
     * @param $node
     * @param $param
     * @return mixed
     */
    public function getRrddata($node,$param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/rrddata',$this->cookie,$param));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function getStatus($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/status',$this->cookie,[]));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function getSubscription($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/subscription',$this->cookie,[]));
    }

    /**
     * @param $node
     * @param $param
     * @return mixed
     */
    public function getSyslog($node,$param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/syslog',$this->cookie,$param));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function getTime($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/time',$this->cookie,[]));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function getVersion($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/version',$this->cookie,[]));
    }

    /**
     * @param $node
     * @param $param
     * @return mixed
     */
    public function getVncwebsocket($node,$param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/vncwebsocket',$this->cookie,$param));
    }

    /**
     * @param $node
     * @param $commands
     * @return mixed
     */
    public function postExecute($node,$commands){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/execute',$this->cookie,[
            'commands' => $commands]));
    }

    /**
     * @param $node
     * @param $param
     * @return mixed
     */
    public function postMigrateall($node,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/migrateall',$this->cookie,$param));
    }

    /**
     * @param $node
     * @param $param
     * @return mixed
     */
    public function postSpiceshell($node,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/spiceshell',$this->cookie,$param));
    }

    /**
     * @param $node
     * @param $param
     * @return mixed
     */
    public function postStartall($node,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/startall',$this->cookie,$param));
    }

    /**
     * @param $node
     * @param $param
     * @return mixed
     */
    public function postStopall($node,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/stopall',$this->cookie,$param));
    }

    /**
     * @param $node
     * @param $param
     * @return mixed
     */
    public function postTermproxy($node,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/termproxy',$this->cookie,$param));
    }

    /**
     * @param $node
     * @param $param
     * @return mixed
     */
    public function postVncshell($node,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/vncshell',$this->cookie,$param));
    }

    /**
     * @param $node
     * @return mixed
     */
    public function postWakeonlan($node){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/wakeonlan',$this->cookie,[]));
    }
}