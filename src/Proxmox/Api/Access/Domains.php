<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access;

use Proxmox\Helper\Interfaces\PVEPathClassInterface;
use Proxmox\Helper\Object\Access\Domains\GET;
use Proxmox\PVE;

/**
 * Class Domains
 * @package proxmox\api\access
 */
class Domains implements PVEPathClassInterface
{
    /**
     * @var string
     */
    private string $pathAdditional;

    /**
     * @var PVE
     */
    private PVE $pve;

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

    /**
     * @return PVE
     */
    public function getPve(): PVE
    {
        return $this->pve;
    }

    /**
     * @param PVE $pve
     */
    public function setPve(PVE $pve): void
    {
        $this->pve = $pve;
    }

    /**
     * Domains constructor.
     * @param PVE $pve
     */
    public function __construct(PVE $pve)
    {
        $this->setPve($pve); //Save PVE in variable $this->pve
    }

    /**
     * GET
     */

    /**
     * Authentication domain index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains
     *
     * @return GET
     */
    public function get(): GET
    {
        $result = $this->getPve()->getApi()->get($this->getPathAdditional());
        $object = new GET();
        $object->fillFromApi($result);

        return $object;
    }

    /**
     * POST
     */

    /**
     * Add an authentication server.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains
     * @param array $params
     * @return mixed
     */
    public function post($params)
    {


        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
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
    public function putRealm($realm, $params)
    {
        return connection::processHttpResponse(connection::putAPI($this->httpClient, $this->apiURL . $realm . '/', $this->cookie, $params));
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
    public function deleteRealm($realm)
    {
        return connection::processHttpResponse(connection::deleteAPI($this->httpClient, $this->apiURL . $realm . '/', $this->cookie));
    }
}