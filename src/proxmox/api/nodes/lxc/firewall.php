<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\lxc;

use GuzzleHttp\Client;
use proxmox\api\nodes\lxc\firewall\aliases;
use proxmox\api\nodes\lxc\firewall\ipSet;
use proxmox\helper\connection;

/**
 * Class firewall
 * @package proxmox\api\nodes\lxc
 */
class firewall
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $CSRFPreventionToken, //CSRF token for auth
        $ticket, //Auth ticket
        $hostname, //Pormxox hostname
        $cookie; //Proxmox auth cookie

    /**
     * firewall constructor.
     * @param $httpClient Client
     * @param $apiURL string
     * @param $CSRFPreventionToken mixed
     * @param $ticket mixed
     * @param $hostname string
     * @param $cookie mixed
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
     * List aliases
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/aliases
     * @return aliases
     */
    public function aliases(){
        return new aliases($this->httpClient,$this->apiURL.'aliases/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * List IPSets
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/ipset
     * @return ipSet
     */
    public function ipSet(){
        return new ipSet($this->httpClient,$this->apiURL.'ipset/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,[]));
    }

    /**
     * Read firewall log
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/log
     * @return mixed|null
     */
    public function getLog(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'log/',$this->cookie,[]));
    }

    /**
     * Get VM firewall options.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/options
     * @return mixed|null
     */
    public function getOptions(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'options/',$this->cookie,[]));
    }

    /**
     * Lists possible IPSet/Alias reference which are allowed in source/dest properties.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/refs
     * @return mixed|null
     */
    public function getRefs(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'refs/',$this->cookie,[]));
    }

    /**
     * PUT
     */

    /**
     * Set Firewall options.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/options
     * @param $param array
     * @return mixed|null
     */
    public function putOptions($param){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'options/',$this->cookie,$param));
    }
}