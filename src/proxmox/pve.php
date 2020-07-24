<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
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

    private static $httpClient, //The http client for the connection to the host
        $username, //Username
        $password, //The password for user
        $host, //Host, ip or domain
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
     */
    public function __construct($param,$debug=false){
        self::$host = $param['hostname']; //Save hostname in class variable
        self::$username = $param['username']; //Save username in class variable
        self::$password = $param['password']; //Save user password in class variable
        self::$port = $param['port']; //Save port in class variable
        self::$authType = $param['authType']; //Save auth type in class variable
        self::$debug = $debug; //Save the debug boolean variable
        self::$apiURL = 'https://'.self::$host.':'.self::$port; //Create the basic api url
        $this->refreshHttpClient();
        $json = json_decode($this->getCSRFPreventionToken(), true); //Get auth CSRF token
        $this->setLoginTokens($json); //Set the login data for the proxmox api
        connection::setCsrfTokenString(self::$CSRFPreventionToken);
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
        self::$CSRFPreventionToken = $json['data']['CSRFPreventionToken']; //Save the CSRF token in class variable
        self::$ticket = $json['data']['ticket']; //Save the ticket in class variable
        return true; //Return true when function finish
    }

    /**
     * Refresh the CSRF token data from proxmox api for api auth
     */
    private static function refreshCSRFToket(){
        $csrfRequest = connection::getCSRFToken(self::$apiURL,self::$username,self::$password,self::$authType,self::$debug); //Get CSRF token
        if($csrfRequest){ //IF CSRF token variable empty/null
            self::$CSRFPreventionToken = $csrfRequest->getBody();
        }
    }

    /**
     * Refresh the http client
     */
    private static function refreshHttpClient(){
        self::$httpClient = new Client(); //Create new http client
    }

    /**
     * Cluster node index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes
     * @return nodes
     */
    public function nodes(){
        return new nodes(self::$httpClient,self::$apiURL,self::$ticket,self::$hostname);
    }

    /**
     * API version details. The result also includes the global datacenter confguration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/version
     * @return version
     */
    public function version(){
        return new version(self::$httpClient,self::$apiURL,self::$ticket,self::$hostname);
    }

    /**
     * Storage index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage
     * @return storage
     */
    public function storage(){
        return new storage(self::$httpClient,self::$apiURL,self::$ticket,self::$hostname);
    }

    /**
     * Pool index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools
     * @return pools
     */
    public function pools(){
        return new pools(self::$httpClient,self::$apiURL,self::$ticket,self::$hostname);
    }

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access
     * @return access
     */
    public function access(){
        return new access(self::$httpClient,self::$apiURL,self::$ticket,self::$hostname);
    }

    /**
     * Cluster index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster
     * @return cluster
     */
    public function cluster(){
        return new cluster(self::$httpClient,self::$apiURL,self::$ticket,self::$hostname);
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
    public static function setHttpClient($httpClient)
    {
        self::$httpClient = $httpClient;
    }

    /**
     * @return mixed
     */
    public static function getUsername()
    {
        return self::$username;
    }

    /**
     * @param mixed $username
     */
    public static function setUsername($username)
    {
        self::$username = $username;
    }

    /**
     * @return mixed
     */
    public static function getPassword()
    {
        return self::$password;
    }

    /**
     * @param mixed $password
     */
    public static function setPassword($password)
    {
        self::$password = $password;
    }

    /**
     * @return mixed
     */
    public static function getHost()
    {
        return self::$host;
    }

    /**
     * @param mixed $host
     */
    public static function setHost($host)
    {
        self::$host = $host;
    }

    /**
     * @return mixed
     */
    public static function getPort()
    {
        return self::$port;
    }

    /**
     * @param mixed $port
     */
    public static function setPort($port)
    {
        self::$port = $port;
    }

    /**
     * @return mixed
     */
    public static function getAuthType()
    {
        return self::$authType;
    }

    /**
     * @param mixed $authType
     */
    public static function setAuthType($authType)
    {
        self::$authType = $authType;
    }

    /**
     * @return bool
     */
    public static function isDebug()
    {
        return self::$debug;
    }

    /**
     * @param bool $debug
     */
    public static function setDebug($debug)
    {
        self::$debug = $debug;
    }

    /**
     * @return mixed
     */
    public static function getCSRFPreventionToken()
    {
        if(!self::$CSRFPreventionToken){
            self::refreshCSRFToket();
        }
        return self::$CSRFPreventionToken;
    }

    /**
     * @param mixed $CSRFPreventionToken
     */
    public static function setCSRFPreventionToken($CSRFPreventionToken)
    {
        self::$CSRFPreventionToken = $CSRFPreventionToken;
    }

    /**
     * @return mixed
     */
    public static function getTicket()
    {
        return self::$ticket;
    }

    /**
     * @param mixed $ticket
     */
    public static function setTicket($ticket)
    {
        self::$ticket = $ticket;
    }

    /**
     * @return string
     */
    public static function getApiURL()
    {
        return self::$apiURL;
    }

    /**
     * @param string $apiURL
     */
    public static function setApiURL($apiURL)
    {
        self::$apiURL = $apiURL;
    }



}