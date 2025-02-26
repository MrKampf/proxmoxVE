<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Tasks
 * @package Proxmox\Api\Cluster
 */
class Tasks extends PVEPathClassBase
{
    /**
     * Tasks constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'tasks/');
    }

    /**
     * List recent tasks (cluster wide).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/tasks
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

}