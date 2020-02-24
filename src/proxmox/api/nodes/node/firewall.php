<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\node;

use GuzzleHttp\Client;
use proxmox\api\nodes\node\firewall\rules;
use proxmox\helper\connection;

/**
 * Class firewall
 * @package proxmox\api\nodes\node
 */
class firewall
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
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/firewall/rules
     * @return rules
     */
    public function rules(){
        return new rules($this->httpClient,$this->apiURL.'rules/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/firewall
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Read firewall log
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/firewall/log
     * @param $params array
     * @return mixed|null
     */
    public function getLog($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'log/',$this->cookie,$params));
    }

    /**
     * Get host firewall options.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/firewall/options
     * @return mixed|null
     */
    public function getOptions(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'options/',$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Set Firewall options.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/firewall/options
     * @param $params array
     * @return mixed|null
     */
    public function postOptions($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'options/',$this->cookie,$params));
    }

}