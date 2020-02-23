<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\lxc\firewall\ipset;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class name
 * @package proxmox\api\nodes\lxc\firewall\ipset
 */
class name
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $CSRFPreventionToken, //CSRF token for auth
        $ticket, //Auth ticket
        $hostname, //Pormxox hostname
        $cookie; //Proxmox auth cookie

    /**
     * name constructor.
     * @param $httpClient Client
     * @param $apiURL string
     * @param $CSRFPreventionToken mixed
     * @param $ticket mixed
     * @param $hostname string
     * @param $cookie mixed
     */
    public function __construct($httpClient, $apiURL, $CSRFPreventionToken, $ticket, $hostname, $cookie){
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL; //Save api url in class variable and change this to current api path
        $this->CSRFPreventionToken = $CSRFPreventionToken; //Save CSRF token in class variable
        $this->ticket = $ticket; //Save auth ticket in class variable
        $this->hostname = $hostname; //Save hostname in class variable
        $this->cookie = $cookie; //Save auth cookie in class variable
    }

    /**
     * GET
     */

    /**
     * List IPSet content
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/ipset/{name}
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient, $this->apiURL, $this->cookie, []));
    }

    /**
     * POST
     */

    /**
     * Add IP or Network to IPSet.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/ipset/{name}
     * @param $param array
     * @return mixed|null
     */
    public function post($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient, $this->apiURL, $this->cookie, $param));
    }

    /**
     * DELETE
     */

    /**
     * Delete IPSet
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/firewall/ipset/{name}
     * @return mixed|null
     */
    public function delete(){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient, $this->apiURL, $this->cookie, []));
    }
}