<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\cluster\firewall;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class rules
 * @package proxmox\api\cluster\firewall
 */
class rules
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * status constructor.
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
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/rules
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get single rule data.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/rules/{pos}
     * @param string $pos
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
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/rules/{pos}
     * @param string $pos
     * @param $param array
     * @return mixed|null
     */
    public function putPos($pos="",$param){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$pos.'/',$this->cookie,$param));
    }

    /**
     * POST
     */

    /**
     * Create new rule.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/rules
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
     * Delete rule.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/rules/{pos}
     * @param string $pos
     * @param $param array
     * @return mixed|null
     */
    public function deletePos($pos="",$param){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$pos.'/',$this->cookie,$param));
    }
}