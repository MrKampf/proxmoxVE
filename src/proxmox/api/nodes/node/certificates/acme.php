<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\api\nodes\node\certificates;

use GuzzleHttp\Client;
use proxmox\helper\connection;

/**
 * Class acme
 * @package proxmox\api\nodes\node\certificates
 */
class acme
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * acme constructor.
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
     * ACME index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/certificates/acme
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * PUT
     */

    /**
     * Renew existing certificate from CA.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/certificates/acme/certificate
     * @param $params array
     * @return mixed
     */
    public function putCertificate($params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.'certificate/',$this->cookie,$params));
    }

    /**
     * POST
     */

    /**
     * Order a new certificate from ACME-compatible CA.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/certificates/acme/certificate
     * @param $params array
     * @return mixed
     */
    public function postCertificate($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL.'certificate/',$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * Revoke existing certificate from CA.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/certificates/acme/certificate
     * @return mixed
     */
    public function deleteCertificate(){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.'certificate/',$this->cookie));
    }
}