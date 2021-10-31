<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Sdn\Ipams;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Ipam
 * @package Proxmox\Api\Cluster\Sdn\Ipams
 */
class Ipam extends PVEPathClassBase
{

    /**
     * Ipam constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Read sdn ipam configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/ipams/{ipam}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update sdn ipam object configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/ipams/{ipam}
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete sdn ipam object configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/ipams/{ipam}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}