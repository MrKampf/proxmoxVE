<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Api\Nodes\Node\Hardware\Pci;
use Proxmox\Api\Nodes\Node\Hardware\Usb;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Hardware
 * @package Proxmox\Api\Nodes\Node
 */
class Hardware extends PVEPathClassBase
{
    /**
     * Apt constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'hardware/');
    }

    /**
     * List local USB devices.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/hardware/usb
     * @return \Proxmox\Api\Nodes\Node\Hardware\Usb
     */
    public function usb(): Usb
    {
        return new Usb($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List local PCI devices.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/hardware/pci
     * @return \Proxmox\Api\Nodes\Node\Hardware\Pci
     */
    public function pci(): Pci
    {
        return new Pci($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Index of hardware types
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/hardware
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}