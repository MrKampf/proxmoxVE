<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster;

use Proxmox\Api\Cluster\BackupInfo\NotBackedUp;
use Proxmox\Helper\Interfaces\PVEPathClassInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class BackupInfo
 * @package Proxmox\Api\Cluster
 */
class BackupInfo extends PVEPathClassBase implements PVEPathClassInterface
{
    /**
     * BackupInfo constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'backup-info/');
    }

    /**
     * Shows all guests which are not covered by any backup job.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup-info/not-backed-up
     * @return NotBackedUp
     */
    public function notBackedUp(): NotBackedUp
    {
        return new NotBackedUp($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Index for backup info related endpoints
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup-info
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

}