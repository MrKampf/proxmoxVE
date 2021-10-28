<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Disks\Zfs;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Name
 * @package Proxmox\Api\Nodes\Node\Disks
 */
class Name extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Get details about a zpool.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/zfs/{name}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}