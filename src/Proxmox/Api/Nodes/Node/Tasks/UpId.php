<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Tasks;

use Proxmox\Api\Nodes\Node\Tasks\UpId\Log;
use Proxmox\Api\Nodes\Node\Tasks\UpId\Status;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class UpId
 * @package Proxmox\Api\Nodes\Node\Tasks
 */
class UpId extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Read task log.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/tasks/{upid}/log
     * @return Log
     */
    public function log(): Log
    {
        return new Log($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read task status.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/tasks/{upid}/status
     * @return Status
     */
    public function status(): Status
    {
        return new Status($this->getPve(), $this->getPathAdditional());
    }

    /**
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/tasks/{upid}
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
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