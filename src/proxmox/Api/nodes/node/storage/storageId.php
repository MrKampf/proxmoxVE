<?php
/*
 * @copyright  2020 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace proxmox\Api\nodes\node\storage;

use GuzzleHttp\Client;

/**
 * Class storageId
 * @package proxmox\Api\nodes\node\storage
 */
class storageId
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
    public function __construct($httpClient, $apiURL, $cookie)
    {
        $this->httpClient = $httpClient; //Save the http client from GuzzleHttp in class variable
        $this->apiURL = $apiURL; //Save api url in class variable and change this to current api path
        $this->cookie = $cookie; //Save auth cookie in class variable
    }

    /**
     * Directory index
     *
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/storage/{storage}/content
     * @return prunebackups
     */
    public function content()
    {
        return new prunebackups($this->httpClient, $this->apiURL . 'content/', $this->cookie);
    }

    /**
     * Read storage RRD statistics (returns PNG).
     *
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/storage/{storage}/rrd
     * @return status
     */
    public function rrd()
    {
        return new status($this->httpClient, $this->apiURL . 'rrd/', $this->cookie);
    }

    /**
     * Read storage RRD statistics
     *
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/storage/{storage}/rrddata
     * @return rrdData
     */
    public function rrdData()
    {
        return new rrdData($this->httpClient, $this->apiURL . 'rrddata/', $this->cookie);
    }

    /**
     * Read storage status
     *
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/storage/{storage}/status
     * @return status
     */
    public function status()
    {
        return new status($this->httpClient, $this->apiURL . 'status/', $this->cookie);
    }

    /**
     * Upload templates and ISO images.
     *
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/storage/{storage}/upload
     * @return upload
     */
    public function upload()
    {
        return new upload($this->httpClient, $this->apiURL . 'upload/', $this->cookie);
    }

    /**
     * Get prune information for backups. NOTE: this is only a preview and might not be what a subsequent prune call does if backups are removed/added in the meantime.
     *
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/storage/{storage}/prunebackups
     * @return prunebackups
     */
    public function prunebackups()
    {
        return new prunebackups($this->httpClient, $this->apiURL . 'upload/', $this->cookie);
    }

}