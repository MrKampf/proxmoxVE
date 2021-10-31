<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Ha\Status;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class ManagerStatus
 * @package Proxmox\Api\Cluster\Ha\Status
 */
class ManagerStatus extends PVEPathClassBase
{
    /**
     * ManagerStatus constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'manager_status/');
    }

    /**
     * Get full HA manger status, including LRM status.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/status/manager_status
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}