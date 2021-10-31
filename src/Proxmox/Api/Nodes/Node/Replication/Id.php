<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Replication;

use Proxmox\Api\Nodes\Node\Replication\Id\Log;
use Proxmox\Api\Nodes\Node\Replication\Id\ScheduleNow;
use Proxmox\Api\Nodes\Node\Replication\Id\Status;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Id
 * @package Proxmox\Api\Nodes\Node\Replication
 */
class Id extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Read replication job log.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/replication/{id}/log
     * @return \Proxmox\Api\Nodes\Node\Replication\Id\Log
     */
    public function log(): Log
    {
        return new Log($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Schedule replication job to start as soon as possible.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/replication/{id}/schedule_now
     * @return \Proxmox\Api\Nodes\Node\Replication\Id\ScheduleNow
     */
    public function scheduleNow(): ScheduleNow
    {
        return new ScheduleNow($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get replication job status.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/replication/{id}/status
     * @return \Proxmox\Api\Nodes\Node\Replication\Id\Status
     */
    public function status(): Status
    {
        return new Status($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/replication/{id}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}