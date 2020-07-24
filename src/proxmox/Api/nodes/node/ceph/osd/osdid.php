<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\nodes\node\ceph\osd;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class osdid
 * @package proxmox\api\nodes\node\ceph\osd
 */
class osdid
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * osdid constructor.
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
     * POST
     */

    /**
     * ceph osd in
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/osd/{osdid}/in
     * @return mixed
     */
    public function postIn(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'in/',$this->cookie));
    }

    /**
     * ceph osd out
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/osd/{osdid}/out
     * @return mixed
     */
    public function postOut(){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'out/',$this->cookie));
    }

    /**
     * Instruct the OSD to scrub.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/osd/{osdid}/scrub
     * @param $params array
     * @return mixed
     */
    public function postScrub($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'scrub/',$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * Destroy OSD
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/ceph/osd/{osdid}
     * @param $params array
     * @return mixed
     */
    public function delete($params){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

}