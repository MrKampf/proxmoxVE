<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Capabilities\Qemu;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Machines
 * @package Proxmox\Api\Nodes\Node\Capabilities\Qemu
 */
class Machines extends PVEPathClassBase
{
    /**
     * Machines constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'machines/');
    }

    /**
     * Get available QEMU/KVM machine types.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/capabilities/qemu/machines
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}