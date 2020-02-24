<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox;

use GuzzleHttp\Client;
use proxmox\api\nodes;
use proxmox\api\storage;
use proxmox\api\version;
use proxmox\Exception\AuthenticationException;
use proxmox\helper\connection;

/**
 * Class pve
 * @package proxmox
 */
class pve
{

    private $hostname, //Pormxox hostname
        $username, //Proxmox username
        $password, //Proxmox user password
        $port, //Proxmox port
        $authType, //Proxmox user type (pve or pam)
        $httpClient, //The http client for connection to proxmox
        $debug, //Want debug connection
        $CSRFPreventionToken, //CSRF token for auth
        $ticket, //Auth ticket
        $apiURL; //API url

    /**
     * pve constructor.
     * @param $param
     * @param bool $debug
     */
    public function __construct($param,$debug=false){
        $this->hostname = $param['hostname']; //Save hostname in class variable
        $this->username = $param['username']; //Save username in class variable
        $this->password = $param['password']; //Save user password in class variable
        $this->port = $param['port']; //Save port in class variable
        $this->authType = $param['authType']; //Save auth type in class variable
        $this->httpClient = new Client(); //Create new http client from GuzzleHttp
        $this->debug = $debug; //Save the debug boolean variable
        $this->apiURL = 'https://'.$this->hostname.':'.$this->port; //Create the basic api url
        $json = json_decode($this->getCSRFToket(), true); //Get auth CSRF token
        $this->setLoginTokens($json); //Set the login data for the proxmox api
    }

    /**
     * Set the login data for the proxmox api
     * @param $json
     * @return bool
     */
    private function setLoginTokens($json){
        if(is_array($json)){ //Is $json are array
            throw new AuthenticationException('Can\'t login with this data.');
        }
        if(array_key_exists('data',$json)){//Is key 'data' in array
            throw new AuthenticationException('Can\'t login with this data.');
        }
        $this->CSRFPreventionToken = $json['data']['CSRFPreventionToken']; //Save the CSRF token in class variable
        $this->ticket = $json['data']['ticket']; //Save the ticket in class variable
        return true; //Return true when function finish
    }

    /**
     * Get CSRF token data from proxmox api for api auth
     * @return \Psr\Http\Message\StreamInterface | null
     */
    private function getCSRFToket(){
        $csrfRequest = connection::getCSRFToken($this->httpClient,$this->apiURL,$this->username,$this->password,$this->authType,$this->debug); //Get CSRF token
        if(!$csrfRequest){ //IF CSRF token variable empty/null
            return null;
        }
        return $csrfRequest->getBody();
    }

    /**
     * Cluster node index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes
     * @return nodes
     */
    public function nodes(){
        return new nodes($this->httpClient,$this->apiURL,$this->ticket,$this->hostname);
    }

    /**
     * API version details. The result also includes the global datacenter confguration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/version
     * @return version
     */
    public function version(){
        return new version($this->httpClient,$this->apiURL,$this->ticket,$this->hostname);
    }

    /**
     * Storage index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage
     * @return storage
     */
    public function storage(){
        return new storage($this->httpClient,$this->apiURL,$this->ticket,$this->hostname);
    }
}