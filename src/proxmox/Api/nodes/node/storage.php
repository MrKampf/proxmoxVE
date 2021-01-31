<?php
/*
 * @copyright  2020 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace proxmox\Api\nodes\node;

use GuzzleHttp\Client;
use proxmox\Api\nodes\node\storage\storageId;
use proxmox\Helper\connection;

/**
 * Class version
 * @package proxmox\api\nodes\node
 */
class storage
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * storage constructor.
     * @param $httpClient Client
     * @param $apiURL string
     * @param $cookie string
     */
    public function __construct(Client $httpClient, string $apiURL, string $cookie)
    {
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL; //Save api url in class variable and change this to current api path
        $this->cookie = $cookie; //Save auth cookie in class variable

    }

    /**
     * Directory index
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/storage/{storage}
     * @param $storage string
     * @return storageId
     */
    public function storageId(string $storage)
    {
        return new storageId($this->httpClient, $this->apiURL . $storage . '/', $this->cookie);
    }

    /**
     * GET
     */

    /**
     * Path: /nodes/{node}/storage
     * Get status for all datastores.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/storage
     * @return mixed|null
     */
    public function get()
    {
        return connection::processHttpResponse(connection::getAPI($this->httpClient, $this->apiURL, $this->cookie));
    }
}
