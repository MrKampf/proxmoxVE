<?php
/*
 * @copyright  2020 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace proxmox\Api\nodes\node\storage;

use GuzzleHttp\Client;
use proxmox\Api\nodes\node\storage\content\volume;
use proxmox\Helper\connection;

/**
 * Class content
 * @package proxmox\api\nodes\node\storage
 */
class upload
{
    private $httpClient, //The http client for connection to proxmox
        $apiURL, //API url
        $cookie; //Proxmox auth cookie

    /**
     * content constructor.
     * @param $httpClient Client
     * @param $apiURL string
     * @param $cookie mixed
     */
    public function __construct(Client $httpClient, string $apiURL, $cookie)
    {
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL; //Save api url in class variable and change this to current api path
        $this->cookie = $cookie; //Save auth cookie in class variable
    }

    /**
     * POST
     */

    /**
     * Upload templates and ISO images.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/storage/{storage}/content
     * @param $params array
     * @return string
     */
    public function post(array $params)
    {
        return connection::processHttpResponse(connection::postAPI($this->httpClient, $this->apiURL, $this->cookie, $params));
    }

}
