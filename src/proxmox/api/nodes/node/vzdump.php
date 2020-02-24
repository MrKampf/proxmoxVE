<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\node;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class vzdump
 * @package proxmox\api\nodes\node
 */
class vzdump
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * vzdump constructor.
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
     * Extract configuration from vzdump backup archive.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/vzdump/extractconfig
     * @param $params array
     * @return mixed
     */
    public function postExtractconfig($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'extractconfig/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Create backup.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/vzdump
     * @param $params array
     * @return mixed
     */
    public function post($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

}