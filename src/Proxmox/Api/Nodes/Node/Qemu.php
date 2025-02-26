<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Api\Nodes\Node\Qemu\VmId;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Qemu
 * @package Proxmox\Api\Nodes\Node
 */
class Qemu extends PVEPathClassBase
{
    /**
     * Apt constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'qemu/');
    }

    /**
     * Directory index
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}
     * @param string $vmId
     * @return VmId
     */
    public function vmId(string $vmId): VmId
    {
        return new VmId($this->getPve(), $this->getPathAdditional() . $vmId . '/');
    }

    /**
     * Virtual machine index (per node).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Create or restore a virtual machine.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}