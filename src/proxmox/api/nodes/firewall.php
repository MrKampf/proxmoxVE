<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes;

use proxmox\api\nodes\firewall\rules;
use proxmox\helper\connection;

/**
 * Class firewall
 * @package proxmox\api\nodes
 */
class firewall
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $CSRFPreventionToken, //CSRF token for auth
        $ticket, //Auth ticket
        $hostname, //Pormxox hostname
        $cookie; //Proxmox auth cookie

    /**
     * firewall constructor.
     * @param $httpClient
     * @param $apiURL
     * @param $CSRFPreventionToken
     * @param $ticket
     * @param $hostname
     * @param $cookie
     */
    public function __construct($httpClient,$apiURL,$CSRFPreventionToken,$ticket,$hostname,$cookie){
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL; //Save api url in class variable and change this to current api path
        $this->CSRFPreventionToken = $CSRFPreventionToken; //Save CSRF token in class variable
        $this->ticket = $ticket; //Save auth ticket in class variable
        $this->hostname = $hostname; //Save hostname in class variable
        $this->cookie = $cookie; //Save auth cookie in class variable
    }

    /**
     * @return mixed|null
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie,[]));
    }

    /**
     * @return mixed|null
     */
    public function getLog(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'log',$this->cookie,[]));
    }

    /**
     * @return mixed|null
     */
    public function getOptions(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.'options',$this->cookie,[]));
    }

    /**
     * @param $param
     * @return mixed|null
     */
    public function postOptions($param){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'options',$this->cookie,$param));
    }

    /**
     * @return rules
     */
    public function rules(){
        return new rules($this->httpClient,$this->apiURL.'/rules/',$this->CSRFPreventionToken,$this->ticket,$this->hostname,$this->cookie);
    }

}