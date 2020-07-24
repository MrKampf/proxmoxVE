<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api;

use proxmox\Api\access\domains;
use proxmox\Api\access\groups;
use proxmox\Api\access\roles;
use proxmox\Api\access\users;
use proxmox\Helper\connection;

/**
 * Class access
 * @package proxmox\api
 */
class access
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $ticket, //Auth ticket
        $hostname, //Pormxox hostname
        $cookie; //Proxmox auth cookie

    /**
     * access constructor.
     * @param $httpClient
     * @param $apiURL
     * @param $ticket
     * @param $hostname
     */
    public function __construct($httpClient,$apiURL,$ticket,$hostname){
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL.'/api2/json/access/'; //Save api url in class variable and change this to current api path
        $this->ticket = $ticket; //Save auth ticket in class variable
        $this->hostname = $hostname; //Save hostname in class variable
        $this->cookie = connection::getCookies($this->ticket,$this->hostname); //Get auth cookie and save in class variable
    }

    /**
     * Authentication domain index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains
     * @return domains
     */
    public function domains(){
        return new domains($this->httpClient,$this->apiURL.'domains/',$this->cookie);
    }

    /**
     * Group index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups
     * @return groups
     */
    public function groups(){
        return new groups($this->httpClient,$this->apiURL.'groups/',$this->cookie);
    }

    /**
     * Role index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/roles
     * @return roles
     */
    public function roles(){
        return new roles($this->httpClient,$this->apiURL.'roles/',$this->cookie);
    }

    /**
     * User index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users
     * @return users
     */
    public function users(){
        return new users($this->httpClient,$this->apiURL.'users/',$this->cookie);
    }

    /**
     * GET
     */

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get Access Control List (ACLs).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/acl
     * @return mixed
     */
    public function getAcl(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'acl/',$this->cookie));
    }

    /**
     * Retrieve effective permissions of given user/token.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/permissions
     * @param $params array
     * @return mixed
     */
    public function getPermissions($params){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'permissions/',$this->cookie,$params));
    }

    /**
     * Dummy. Useful for formatters which want to provide a login page.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/ticket
     * @return mixed
     */
    public function getTicket(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'ticket/',$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Update Access Control List (add or remove permissions).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/acl
     * @param $params array
     * @return mixed
     */
    public function putAcl($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'acl/',$this->cookie,$params));
    }

    /**
     * Change user password.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/password
     * @param $params array
     * @return mixed
     */
    public function putPassword($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'password/',$this->cookie,$params));
    }

    /**
     * Change user u2f authentication.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/tfa
     * @param $params array
     * @return mixed
     */
    public function putTfa($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'tfa/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Finish a u2f challenge.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/tfa
     * @param $params array
     * @return mixed
     */
    public function postTfa($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'tfa/',$this->cookie,$params));
    }

    /**
     * Create or verify authentication ticket.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/ticket
     * @param $params array
     * @return mixed
     */
    public function postTicket($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'ticket/',$this->cookie,$params));
    }
}