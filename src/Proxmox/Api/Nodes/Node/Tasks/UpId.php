<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Tasks;

use Proxmox\Api\Nodes\Node\Tasks\UpId\Log;
use Proxmox\Api\Nodes\Node\Tasks\UpId\Status;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class UpId
 * @package Proxmox\Api\Nodes\Node\Tasks
 */
class UpId extends PVEPathClassBase
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
     * Read task log.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/tasks/{upid}/log
     * @return \Proxmox\Api\Nodes\Node\Tasks\UpId\Log
     */
    public function log(): Log
    {
        return new Log($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read task status.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/tasks/{upid}/status
     * @return \Proxmox\Api\Nodes\Node\Tasks\UpId\Status
     */
    public function status(): Status
    {
        return new Status($this->getPve(), $this->getPathAdditional());
    }

    /**
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/tasks/{upid}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Stop a task.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/tasks/{upid}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}