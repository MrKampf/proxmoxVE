<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api;

use proxmox\api\nodes\apt;
use proxmox\api\nodes\ceph;
use proxmox\api\nodes\certificates;
use proxmox\api\nodes\disks;
use proxmox\api\nodes\lxc;
use proxmox\api\nodes\qemu;
use proxmox\helper\connection;

/**
 * Class nodes
 * @package proxmox\api
 */
class nodes
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $CSRFPreventionToken, //CSRF token for auth
        $ticket, //Auth ticket
        $hostname, //Pormxox hostname
        $cookie; //Proxmox auth cookie

    /**
     * nodes constructor.
     * @param $httpClient
     * @param $apiURL
     * @param $CSRFPreventionToken
     * @param $ticket
     * @param $hostname
     */
    public function __construct($httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname){
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL.'/api2/json/nodes/'; //Save api url in class variable and change this to current api path
        $this->CSRFPreventionToken = $CSRFPreventionToken; //Save CSRF token in class variable
        $this->ticket = $ticket; //Save auth ticket in class variable
        $this->hostname = $hostname; //Save hostname in class variable
        $this->cookie = connection::getCookies($this->ticket,$this->hostname); //Get auth cookie and save in class variable
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/apt
     * @param $node
     * @return apt
     */
    public function apt($node){
        return new apt($this->httpClient,$this->apiURL.$node.'/apt/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph
     * @param $node
     * @return ceph
     */
    public function ceph($node){
        return new ceph($this->httpClient,$this->apiURL.$node.'/ceph/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/certificates
     * @param $node
     * @return certificates
     */
    public function certificates($node){
        return new certificates($this->httpClient,$this->apiURL.$node.'/certificates/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/disks
     * @param $node
     * @return disks
     */
    public function disks($node){
        return new disks($this->httpClient,$this->apiURL.$node.'/disks/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc
     * @param $node integer Node name
     * @param $vmid integer VMID (unique) ID of the vm
     * @return lxc
     */
    public function lxc($node,$vmid){
        return new lxc($this->httpClient,$this->apiURL.$node.'/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie,$vmid);
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu
     * @param $node
     * @return qemu
     */
    public function qemu($node){
        return new qemu($this->httpClient,$this->apiURL.$node.'/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * GET
     */

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,[]));
    }

    //TODO//Delete on version 2.0.0<
    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/status
     * @param $node
     * @return mixed
     */
    public function getNode($node){
        return $this->getStatus($node);
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc
     * @param $node
     * @return mixed
     */
    public function getLxc($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/lxc',$this->cookie,[]));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/aplinfo
     * @param $node
     * @return mixed
     */
    public function getAplinfo($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/aplinfo',$this->cookie,[]));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/config
     * @param $node
     * @return mixed
     */
    public function getConfig($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/config',$this->cookie,[]));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/dns
     * @param $node
     * @return mixed
     */
    public function getDNS($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/dns',$this->cookie,[]));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/hosts
     * @param $node
     * @return mixed
     */
    public function getHosts($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/hosts',$this->cookie,[]));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/journal
     * @param $node
     * @param $param
     * @return mixed
     */
    public function getJournal($node,$param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/journal',$this->cookie,$param));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/netstat
     * @param $node
     * @return mixed
     */
    public function getNetstat($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/netstat',$this->cookie,[]));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/report
     * @param $node
     * @return mixed
     */
    public function getReport($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/report',$this->cookie,[]));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/rrd
     * @param $node
     * @return mixed
     */
    public function getRrd($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/rrd',$this->cookie,[]));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/rrddata
     * @param $node
     * @param $param
     * @return mixed
     */
    public function getRrddata($node,$param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/rrddata',$this->cookie,$param));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/status
     * @param $node
     * @return mixed
     */
    public function getStatus($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/status',$this->cookie,[]));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/subscription
     * @param $node
     * @return mixed
     */
    public function getSubscription($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/subscription',$this->cookie,[]));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/syslog
     * @param $node
     * @param $param
     * @return mixed
     */
    public function getSyslog($node,$param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/syslog',$this->cookie,$param));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/time
     * @param $node
     * @return mixed
     */
    public function getTime($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/time',$this->cookie,[]));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/version
     * @param $node
     * @return mixed
     */
    public function getVersion($node){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/version',$this->cookie,[]));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/vncwebsocket
     * @param $node
     * @param $param
     * @return mixed
     */
    public function getVncwebsocket($node,$param){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$node.'/vncwebsocket',$this->cookie,$param));
    }

    /**
     * POST
     */

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/dns
     * @param $node
     * @param $commands
     * @return mixed
     */
    public function postExecute($node,$commands){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/execute',$this->cookie,[
            'commands' => $commands]));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/migrateall
     * @param $node
     * @param $param
     * @return mixed
     */
    public function postMigrateall($node,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/migrateall',$this->cookie,$param));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/spiceshell
     * @param $node
     * @param $param
     * @return mixed
     */
    public function postSpiceshell($node,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/spiceshell',$this->cookie,$param));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/startall
     * @param $node
     * @param $param
     * @return mixed
     */
    public function postStartall($node,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/startall',$this->cookie,$param));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/stopall
     * @param $node
     * @param $param
     * @return mixed
     */
    public function postStopall($node,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/stopall',$this->cookie,$param));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/termproxy
     * @param $node
     * @param $param
     * @return mixed
     */
    public function postTermproxy($node,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/termproxy',$this->cookie,$param));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/vncshell
     * @param $node
     * @param $param
     * @return mixed
     */
    public function postVncshell($node,$param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/vncshell',$this->cookie,$param));
    }

    /**
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/wakeonlan
     * @param $node
     * @return mixed
     */
    public function postWakeonlan($node){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.$node.'/wakeonlan',$this->cookie,[]));
    }
}