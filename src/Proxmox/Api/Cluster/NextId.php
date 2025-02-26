<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class NextId
 * @package Proxmox\Api\Cluster
 */
class NextId extends PVEPathClassBase
{
    /**
     * NextId constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'nextid/');
    }

    /**
     * Get next free VMID. If you pass an VMID it will raise an error if the ID is already used.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/nextid
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

}