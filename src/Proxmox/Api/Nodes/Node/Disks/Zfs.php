<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Disks;

use Proxmox\Api\Nodes\Node\Disks\Zfs\Name;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Zfs
 * @package Proxmox\Api\Nodes\Node\Disks
 */
class Zfs extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'zfs/');
    }

    /**
     * Get details about a zpool.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/zfs/{name}
     * @param string $name
     * @return Name
     */
    public function name(string $name): Name
    {
        return new Name($this->getPve(), $this->getPathAdditional() . $name . '/');
    }

    /**
     * List Zpools.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/zfs
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create a ZFS pool.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/zfs
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}