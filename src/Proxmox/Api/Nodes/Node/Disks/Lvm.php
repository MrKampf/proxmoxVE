<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Disks;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Lvm
 * @package Proxmox\Api\Nodes\Node\Disks
 */
class Lvm extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'lvm/');
    }

    /**
     * List LVM Volume Groups
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/lvm
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create an LVM Volume Group
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/lvm
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}