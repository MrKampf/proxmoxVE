<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Ha;

use Proxmox\Api\Cluster\Ha\Resources\Sid;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Resources
 * @package Proxmox\Api\Cluster\Ha
 */
class Resources extends PVEPathClassBase
{
    /**
     * Resources constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'resources/');
    }

    /**
     * Read resource configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/resources/{sid}
     * @param string $sid
     * @return Sid
     */
    public function sid(string $sid): Sid
    {
        return new Sid($this->getPve(), $this->getPathAdditional() . $sid . '/');
    }

    /**
     * List HA resources.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/resources
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create a new HA resource.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/resources
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}