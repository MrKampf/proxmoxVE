<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Ha;

use Proxmox\Api\Cluster\Ha\Status\Current;
use Proxmox\Api\Cluster\Ha\Status\ManagerStatus;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Status
 * @package Proxmox\Api\Cluster\Ha
 */
class Status extends PVEPathClassBase
{
    /**
     * Status constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'status/');
    }

    /**
     * Get full HA manger status, including LRM status.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/status/manager_status
     * @return Current
     */
    public function current(): Current
    {
        return new Current($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get full HA manger status, including LRM status.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/status/manager_status
     * @return ManagerStatus
     */
    public function managerStatus(): ManagerStatus
    {
        return new ManagerStatus($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List HA resources.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/status
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}