<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Backup;


use Proxmox\Api\Cluster\Backup\Id\IncludedVolumes;
use Proxmox\Helper\Interfaces\PVEPathClassInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Id
 * @package Proxmox\Api\Cluster\Backup
 */
class Id extends PVEPathClassBase implements PVEPathClassInterface
{

    /**
     * Id constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Returns included guests and the backup status of their disks. Optimized to be used in ExtJS tree views.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup/{id}/included_volumes
     * @return IncludedVolumes
     */
    public function includedVolumes(): IncludedVolumes
    {
        return new IncludedVolumes($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read vzdump backup job definition.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup/{id}
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Update vzdump backup job definition.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup/{id}
     * @param array $params
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete vzdump backup job definition.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup/{id}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}