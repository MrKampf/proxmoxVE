<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Ceph;

use Proxmox\Api\Cluster\Ceph\Flags\Flag;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Flags
 * @package Proxmox\Api\Cluster\Ceph
 */
class Flags extends PVEPathClassBase
{
    /**
     * Flags constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'flags/');
    }

    /**
     * Get the status of a specific ceph flag.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/flags/{flag}
     * @param string $flag
     * @return Flag
     */
    public function flag(string $flag): Flag
    {
        return new Flag($this->getPve(), $this->getPathAdditional() . $flag . '/');
    }

    /**
     * Get the status of all ceph flags
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/flags
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Set/Unset multiple ceph flags at once.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/flags
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }
}