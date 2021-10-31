<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Capabilities;

use Proxmox\Api\Nodes\Node\Capabilities\Qemu\Cpu;
use Proxmox\Api\Nodes\Node\Capabilities\Qemu\Machines;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Qemu
 * @package Proxmox\Api\Nodes\Node\Capabilities
 */
class Qemu extends PVEPathClassBase
{
    /**
     * Qemu constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'qemu/');
    }

    /**
     * List all custom and default CPU models.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/capabilities/qemu/cpu
     * @return Cpu
     */
    public function cpu(): Cpu
    {
        return new Cpu($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get available QEMU/KVM machine types.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/capabilities/qemu/machines
     * @return Machines
     */
    public function machines(): Machines
    {
        return new Machines($this->getPve(), $this->getPathAdditional());
    }

    /**
     * QEMU capabilities index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/capabilities/qemu
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}