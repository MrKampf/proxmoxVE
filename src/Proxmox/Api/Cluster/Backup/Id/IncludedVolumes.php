<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Backup\Id;

use Proxmox\Helper\Interfaces\PVEPathClassInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class IncludedVolumes
 * @package Proxmox\Api\Cluster\Backup\Id
 */
class IncludedVolumes extends PVEPathClassBase implements PVEPathClassInterface
{

    /**
     * id constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'included_volumes/');
    }

    /**
     * Returns included guests and the backup status of their disks. Optimized to be used in ExtJS tree views.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup/{id}/included_volumes
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

}