<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Api\Nodes\Node\Tasks\UpId;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Tasks
 * @package Proxmox\Api\Nodes\Node
 */
class Tasks extends PVEPathClassBase
{
    /**
     * Apt constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'tasks/');
    }

    /**
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/tasks/{upid}
     * @param string $upId
     * @return UpId
     */
    public function upId(string $upId): UpId
    {
        return new UpId($this->getPve(), $this->getPathAdditional() . $upId . '/');
    }

    /**
     * Read task list for one node (finished tasks).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/tasks
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}