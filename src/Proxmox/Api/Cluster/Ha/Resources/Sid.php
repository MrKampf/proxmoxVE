<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Ha\Resources;

use Proxmox\Api\Cluster\Ha\Resources\Sid\Migrate;
use Proxmox\Api\Cluster\Ha\Resources\Sid\Relocate;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Sid
 * @package Proxmox\Api\Cluster\Ha\Resources
 */
class Sid extends PVEPathClassBase
{
    /**
     * Sid constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Request resource migration (online) to another node.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/resources/{sid}/migrate
     * @return Migrate
     */
    public function migrate(): Migrate
    {
        return new Migrate($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Request resource migration (online) to another node.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/resources/{sid}/migrate
     * @return Relocate
     */
    public function relocate(): Relocate
    {
        return new Relocate($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read resource configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/resources/{sid}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update resource configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/resources/{sid}
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete resource configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/resources/{sid}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}