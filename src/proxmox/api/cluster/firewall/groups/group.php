<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\cluster\firewall\groups;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class group
 * @package proxmox\api\cluster\firewall\groups
 */
class group
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * ipSet constructor.
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
     * GET
     */

    /**
     * List rules.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/groups/{group}
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get single rule data.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/groups/{group}/{pos}
     * @param $pos string
     * @return mixed|null
     */
    public function getPos($pos=""){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$pos.'/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Modify rule data.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/groups/{group}/{pos}
     * @param $pos string
     * @param $params array
     * @return mixed|null
     */
    public function putPos($pos="",$params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$pos.'/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Create new rule.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/groups/{group}
     * @param $param array
     * @return mixed|null
     */
    public function post($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$param));
    }

    /**
     * DELETE
     */

    /**
     * Delete security group.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/groups/{group}
     * @return mixed|null
     */
    public function delete(){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Delete rule.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/groups/{group}/{pos}
     * @param $pos string
     * @param $params array
     * @return mixed|null
     */
    public function deletePos($pos="",$params){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$pos.'/',$this->cookie,$params));
    }

}