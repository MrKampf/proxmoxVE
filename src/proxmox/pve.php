<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox;

use GuzzleHttp\Client;
use proxmox\api\access;
use proxmox\api\nodes;
use proxmox\Exception\AuthenticationException;

class pve
{
    private $hostname,$username,$password,$port,$authType,$httpClient,$debug,$CSRFPreventionToken,$ticket,$apiURL;

    public function __construct($param,$debug=false){
        $this->hostname = $param['hostname'];
        $this->username = $param['username'];
        $this->password = $param['password'];
        $this->port = $param['port'];
        $this->authType = $param['authType'];
        $this->httpClient = new Client();
        $this->debug = $debug;
        $this->apiURL = 'https://'.$this->hostname.':'.$this->port;
        $json = json_decode($this->getCSRFToket(), true);
        $this->setLoginTokens($json);
    }

    private function setLoginTokens($json){
        if(!$json['data']){
            $errorMSG = 'Can not login with this data.';
            throw new AuthenticationException($errorMSG);
        }
        $this->CSRFPreventionToken = $json['data']['CSRFPreventionToken'];
        $this->ticket = $json['data']['ticket'];
    }


    private function getCSRFToket(){
        $csrfRequest = $this->httpClient->post($this->apiURL.'/api2/json/access/ticket', [
            'verify' => false,
            'debug' => $this->debug,
            'form_params' => [
                'username' => $this->username,
                'password' => $this->password,
                'realm' => $this->authType,
            ],
        ]);
        return $csrfRequest->getBody();
    }

    /**
     * @return nodes
     */
    public function nodes(){
        return new nodes($this->httpClient,$this->apiURL,$this->CSRFPreventionToken,$this->ticket,$this->hostname);
    }

    /**
     * @return access
     */
    public function access(){
        return new access($this->httpClient,$this->apiURL,$this->CSRFPreventionToken,$this->ticket,$this->hostname);
    }
}