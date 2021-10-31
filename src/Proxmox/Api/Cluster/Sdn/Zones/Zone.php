<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Sdn\Zones;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Zone
 * @package Proxmox\Api\Cluster\Sdn\Zones
 */
class Zone extends PVEPathClassBase
{
    /**
     * Zone constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Read sdn zone configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/zones/{zone}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update sdn zone object configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/zones/{zone}
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete sdn zone object configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/zones/{zone}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}