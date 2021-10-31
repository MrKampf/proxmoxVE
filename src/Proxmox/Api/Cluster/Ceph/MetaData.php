<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Ceph;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class MetaData
 * @package Proxmox\Api\Cluster\Ceph
 */
class MetaData extends PVEPathClassBase
{
    /**
     * MetaData constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'metadata/');
    }

    /**
     * Get ceph metadata.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/metadata
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}