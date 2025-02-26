<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Qemu\VmId\Status;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Reboot
 * @package Proxmox\Api\Nodes\Node\Qemu\VmId\Status
 */
class Reboot extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'reboot/');
    }

    /**
     * Reboot the container by shutting it down, and starting it again. Applies pending changes.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/status/reboot
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}