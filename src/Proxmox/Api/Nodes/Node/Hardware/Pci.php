<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Hardware;

use Proxmox\Api\Nodes\Node\Hardware\Pci\PciId;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Pci
 * @package Proxmox\Api\Nodes\Node\Hardware
 */
class Pci extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'pci/');
    }

    /**
     * Index of available pci methods
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/hardware/pci/{pciid}
     * @param string $pciId
     * @return PciId
     */
    public function pciId(string $pciId): PciId
    {
        return new PciId($this->getPve(), $this->getPathAdditional() . $pciId . '/');
    }

    /**
     * List local PCI devices.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/hardware/pci
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}