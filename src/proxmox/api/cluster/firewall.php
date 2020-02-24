<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\cluster;

use GuzzleHttp\Client;
use proxmox\api\cluster\firewall\aliases;
use proxmox\api\cluster\firewall\groups;
use proxmox\api\cluster\firewall\rules;
use proxmox\api\cluster\firewall\ipSet;
use proxmox\helper\connection;

/**
 * Class firewall
 * @package proxmox\api\cluster
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
     * List aliases
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/aliases
     * @return aliases
     */
    public function aliases(){
        return new aliases($this->httpClient,$this->apiURL.'aliases/',$this->cookie);
    }

    /**
     * List security groups.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/groups
     * @return groups
     */
    public function groups(){
        return new groups($this->httpClient,$this->apiURL.'groups/',$this->cookie);
    }

    /**
     * List IPSets
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/ipset
     * @return ipSet
     */
    public function ipSet(){
        return new ipSet($this->httpClient,$this->apiURL.'ipset/',$this->cookie);
    }

    /**
     * List rules.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/rules
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
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * List available macros
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/macros
     * @return mixed|null
     */
    public function getMacros(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'macros/',$this->cookie));
    }

    /**
     * Get Firewall options.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/options
     * @return mixed|null
     */
    public function getOptions(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'options/',$this->cookie));
    }

    /**
     * Lists possible IPSet/Alias reference which are allowed in source/dest properties.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/refs
     * @param $params array
     * @return mixed|null
     */
    public function getRefs($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'refs/',$this->cookie,$params));
    }

    /**
     * PUT
     */

    /**
     * Set Firewall options.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/firewall/options
     * @param $params array
     * @return mixed|null
     */
    public function putOptions($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'options/',$this->cookie,$params));
    }

}