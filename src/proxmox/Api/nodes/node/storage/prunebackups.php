<?php
/*
 * @copyright  2020 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace proxmox\Api\nodes\node\storage;

use GuzzleHttp\Client;
use proxmox\Helper\connection;

/**
 * Class content
 * @package proxmox\api\nodes\node\storage
 */
class prunebackups
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
     * GET
     */

    /**
     * Get prune information for backups. NOTE: this is only a preview and might not be what a subsequent prune call does if backups are removed/added in the meantime.
     *
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/storage/{storage}/prunebackups
     * @param $params array
     * @return mixed|null
     */
    public function get(array $params)
    {
        return connection::processHttpResponse(connection::getAPI($this->httpClient, $this->apiURL, $this->cookie, $params));
    }

    /**
     * DELETE
     */

    /**
     * Prune backups. Only those using the standard naming scheme are considered.
     *
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/storage/{storage}/prunebackups
     * @param array $params
     * @return string
     */
    public function delete(array $params)
    {
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient, $this->apiURL, $this->cookie, $params));
    }

}
