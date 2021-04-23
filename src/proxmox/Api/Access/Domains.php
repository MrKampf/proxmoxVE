<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */
namespace proxmox\Api\Access;

use GuzzleHttp\Client;
use proxmox\Api\Access;

/**
 * Class domains
 * @package proxmox\api\access
 */
class Domains extends Access
{
    /**
     * @var string
     */
    public string $pathAdditional;

    /**
     * @return string
     */
    public function getPathAdditional(): string
    {
        return $this->pathAdditional;
    }

    /**
     * @param string $pathAdditional
     */
    public function setPathAdditional(string $pathAdditional): void
    {
        $this->pathAdditional = $pathAdditional;
    }

    public function __construct(string $hostname, string $username, string $password, int $port, string $authType, bool $debug, string $pathAdditional)
    {
        $this->setPathAdditional($pathAdditional."domains/");
        parent::__construct($hostname, $username, $password, $port, $authType, $debug, $pathAdditional);
    }

    /**
     * GET
     */

    /**
     * Authentication domain index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains
     * @return mixed
     */
    public function get(){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL,$this->cookie));
    }

    /**
     * Get auth server configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains/{realm}
     * @param $realm string
     * @return mixed|null
     */
    public function getRealm($realm){
        return connection::processHttpResponse(connection::getAPI($this->httpClient,$this->apiURL.$realm.'/',$this->cookie));
    }

    /**
     * POST
     */

    /**
     * Add an authentication server.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains
     * @param $params array
     * @return mixed
     */
    public function post($params){
        return connection::processHttpResponse(connection::postAPI($this->httpClient,$this->apiURL,$this->cookie,$params));
    }

    /**
     * PUT
     */

    /**
     * Update authentication server settings.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains/{realm}
     * @param $realm string
     * @param $params array
     * @return mixed|null
     */
    public function putRealm($realm,$params){
        return connection::processHttpResponse(connection::putAPI($this->httpClient,$this->apiURL.$realm.'/',$this->cookie,$params));
    }

    /**
     * DELETE
     */

    /**
     * Delete an authentication server.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains/{realm}
     * @param $realm string
     * @return mixed|null
     */
    public function deleteRealm($realm){
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient,$this->apiURL.$realm.'/',$this->cookie));
    }
}