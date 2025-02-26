<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\BackupInfo;

use Proxmox\Helper\Interfaces\PVEPathClassInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class NotBackedUp
 * @package Proxmox\Api\Cluster\Backupinfo
 */
class NotBackedUp extends PVEPathClassBase implements PVEPathClassInterface
{
    /**
     * NotBackedUp constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'not-backed-up/');
    }

    /**
     * Shows all guests which are not covered by any backup job.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup-info/not-backed-up
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

}