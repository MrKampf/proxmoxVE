<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\cluster\firewall;

use GuzzleHttp\Client;
use proxmox\Api\cluster\firewall\groups\group;
use proxmox\Helper\connection;

/**
 * Class groups
 * @package proxmox\api\cluster\firewall
 */
class groups
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * firewall constructor.
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
     * List rules.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/groups/{group}
     * @param $group string
     * @return group
     */
    public function group($group){
        return new group($this->httpClient,$this->apiURL.$group.'/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * List security groups.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/groups
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Create new security group.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/groups
     * @param $param array
     * @return mixed|null
     */
    public function post($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$param));
    }

}