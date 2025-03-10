<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Capabilities\Qemu;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Machines
 * @package Proxmox\Api\Nodes\Node\Capabilities\Qemu
 */
class Machines extends PVEPathClassBase
{
    /**
     * Machines constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'machines/');
    }

    /**
     * Get available QEMU/KVM machine types.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/capabilities/qemu/machines
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}