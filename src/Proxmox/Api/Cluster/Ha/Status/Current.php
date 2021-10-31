<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Ha\Status;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Current
 * @package Proxmox\Api\Cluster\Ha\Status
 */
class Current extends PVEPathClassBase
{
    /**
     * Current constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'current/');
    }

    /**
     * Get full HA manger status, including LRM status.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/status/current
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}