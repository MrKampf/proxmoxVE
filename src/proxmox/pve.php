<?php
/*
 * @copyright  2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox;

use GuzzleHttp\Client;
use proxmox\Api\access;
use proxmox\Api\cluster;
use proxmox\Api\nodes;
use proxmox\Api\pools;
use proxmox\Api\storage;
use proxmox\Api\version;
use proxmox\Exception\AuthenticationException;
use proxmox\Helper\connection;

/**
 * Class pve
 * @package proxmox
 */
class pve
{
    private static $httpClient; //The http client for the connection to the host

    private
        $username, //Username
        $password, //The password for user
        $hostname, //Host, ip or domain
        $port, //Proxmox api port
        $authType, //User type (pve or pam)
        $debug, //Want debug connection
        $CSRFPreventionToken, //CSRF token for auth
        $ticket, //Auth ticket
        $apiURL; //API url

    /**
     * pve constructor.
     * @param $param
     * @param bool $debug
     * @deprecated Changed in next version
     */
    public function __construct($param,$debug=false){
        $this->hostname = $param['hostname']; //Save hostname in class variable
        $this->username = $param['username']; //Save username in class variable
        $this->password = $param['password']; //Save user password in class variable
        $this->port = $param['port']; //Save port in class variable
        $this->authType = $param['authType']; //Save auth type in class variable
        $this->debug = $debug; //Save the debug boolean variable
        $this->apiURL = 'https://'.$this->hostname.':'.$this->port; //Create the basic api url
        $this->refreshHttpClient();
        $json = json_decode($this->getCSRFPreventionToken(), true); //Get auth CSRF token
        $this->setLoginTokens($json); //Set the login data for the proxmox api
        connection::setCsrfTokenString($this->CSRFPreventionToken);
    }

    /**
     * Set the login data for the proxmox api
     * @param $json
     * @return bool
     */
    private function setLoginTokens($json){
        if(!is_array($json)){ //Is $json are array
            throw new AuthenticationException('Can\'t login with this data.');
        }
        if(!array_key_exists('data',$json)){//Is key 'data' in array
            throw new AuthenticationException('Can\'t login with this data.');
        }
        $this->CSRFPreventionToken = $json['data']['CSRFPreventionToken']; //Save the CSRF token in class variable
        $this->ticket = $json['data']['ticket']; //Save the ticket in class variable
        return true; //Return true when function finish
    }

    /**
     * Refresh the CSRF token data from proxmox api for api auth
     */
    private function refreshCSRFToket(){
        $csrfRequest = connection::getCSRFToken($this->apiURL,$this->username,$this->password,$this->authType,$this->debug); //Get CSRF token
        if($csrfRequest){ //IF CSRF token variable empty/null
            $this->CSRFPreventionToken = $csrfRequest->getBody();
        }
    }

    /**
     * Refresh the http client
     */
    private function refreshHttpClient(){
        $this->setHttpClient(new Client()); //Create new http client
    }

    /**
     * Cluster node index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes
     * @return nodes
     * @deprecated Changed in next version
     */
    public function nodes(){
        return new nodes(self::$httpClient,$this->apiURL,$this->ticket,$this->hostname);
    }

    /**
     * API version details. The result also includes the global datacenter confguration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/version
     * @return version
     * @deprecated Changed in next version
     */
    public function version(){
        return new version(self::$httpClient,$this->apiURL,$this->ticket,$this->hostname);
    }

    /**
     * Storage index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage
     * @return storage
     * @deprecated Changed in next version
     */
    public function storage(){
        return new storage(self::$httpClient,$this->apiURL,$this->ticket,$this->hostname);
    }

    /**
     * Pool index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools
     * @return pools
     * @deprecated Changed in next version
     */
    public function pools(){
        return new pools(self::$httpClient,$this->apiURL,$this->ticket,$this->hostname);
    }

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access
     * @return access
     * @deprecated Changed in next version
     */
    public function access(){
        return new access(self::$httpClient,$this->apiURL,$this->ticket,$this->hostname);
    }

    /**
     * Cluster index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster
     * @return cluster
     * @deprecated Changed in next version
     */
    public function cluster(){
        return new cluster(self::$httpClient,$this->apiURL,$this->ticket,$this->hostname);
    }

    /**
     * @return Client
     */
    public static function getHttpClient()
    {
        if(!self::$httpClient){
            self::refreshHttpClient();
        }
        return self::$httpClient;
    }

    /**
     * @param Client $httpClient
     */
    public function setHttpClient($httpClient)
    {
        self::$httpClient = $httpClient;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->hostname;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->hostname = $host;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getAuthType()
    {
        return $this->authType;
    }

    /**
     * @param mixed $authType
     */
    public function setAuthType($authType)
    {
        $this->authType = $authType;
    }

    /**
     * @return bool
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @param bool $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * @return mixed
     */
    public function getCSRFPreventionToken()
    {
        if(!$this->CSRFPreventionToken){
            self::refreshCSRFToket();
        }
        return $this->CSRFPreventionToken;
    }

    /**
     * @param mixed $CSRFPreventionToken
     */
    public function setCSRFPreventionToken($CSRFPreventionToken)
    {
        $this->CSRFPreventionToken = $CSRFPreventionToken;
    }

    /**
     * @return mixed
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param mixed $ticket
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * @return string
     */
    public function getApiURL()
    {
        return $this->apiURL;
    }

    /**
     * @param string $apiURL
     */
    public function setApiURL($apiURL)
    {
        $this->apiURL = $apiURL;
    }



}