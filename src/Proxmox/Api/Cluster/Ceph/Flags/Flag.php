<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Ceph\Flags;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Flag
 * @package Proxmox\Api\Cluster\Ceph\Flags
 */
class Flag extends PVEPathClassBase
{
    /**
     * Flags constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Get the status of a specific ceph flag.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/flags/{flag}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Set or clear (unset) a specific ceph flag
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/flags/{flag}
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }
}