<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Backup\Id;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class IncludedVolumes
 * @package Proxmox\Api\Cluster\Backup\Id
 */
class IncludedVolumes extends PVEPathClassBase
{

    /**
     * id constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'included_volumes/');
    }

    /**
     * Returns included guests and the backup status of their disks. Optimized to be used in ExtJS tree views.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup/{id}/included_volumes
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}