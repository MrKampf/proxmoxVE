<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Qemu\VmId;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Monitor
 * @package Proxmox\Api\Nodes\Node\Qemu\VmId
 */
class Monitor extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'monitor/');
    }

    /**
     * Execute Qemu monitor commands.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/monitor
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}