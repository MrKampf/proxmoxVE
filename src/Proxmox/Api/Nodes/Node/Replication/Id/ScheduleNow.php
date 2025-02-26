<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Replication\Id;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class ScheduleNow
 * @package Proxmox\Api\Nodes\Node\Replication\Id
 */
class ScheduleNow extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'log/');
    }

    /**
     * Schedule replication job to start as soon as possible.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/replication/{id}/schedule_now
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}