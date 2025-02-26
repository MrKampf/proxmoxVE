<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Ceph\Flags;

use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Flag
 * @package Proxmox\Api\Cluster\Ceph\Flags
 */
class Flag extends PVEPathClassBase implements PVEPathEndpointInterface
{
    /**
     * Flags constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Get the status of a specific ceph flag.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/flags/{flag}
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Set or clear (unset) a specific ceph flag
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/flags/{flag}
     * @param array $params
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }
}