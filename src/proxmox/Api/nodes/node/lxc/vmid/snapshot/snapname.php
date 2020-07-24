<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes\lxc\snapshot;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class snapname
 * @package proxmox\api\nodes\lxc\snapshot
 */
class snapname
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * snapname constructor.
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
     * -
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/snapshot/{snapname}
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get snapshot configuration
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/snapshot/{snapname}/config
     * @return mixed|null
     */
    public function getConfig(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'config/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update snapshot metadata.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/snapshot/{snapname}/config
     * @param $params array
     * @return mixed|null
     */
    public function putConfig($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'config/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Rollback LXC state to specified snapshot.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/snapshot/{snapname}/rollback
     * @return mixed|null
     */
    public function postRollback(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'rollback/',$this->cookie));
    }

    /**
     * DELETE
     */

    /**
     * Delete a LXC snapshot.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc/{vmid}/snapshot/{snapname}
     * @param $params array
     * @return mixed|null
     */
    public function delete($params){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }


}