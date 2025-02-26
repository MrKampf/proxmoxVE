<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Qemu\VmId\Agent;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class SuspendHybrid
 * @package Proxmox\Api\Nodes\Node\Qemu\VmId\Agent
 */
class SuspendHybrid extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'suspend-hybrid/');
    }

    /**
     * Execute suspend-hybrid.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/agent/suspend-hybrid
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}