<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster;

use Proxmox\Api\Cluster\Ceph\Flags;
use Proxmox\Api\Cluster\Ceph\MetaData;
use Proxmox\Api\Cluster\Ceph\Status;
use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Ceph
 * @package Proxmox\Api\Cluster
 */
class Ceph extends PVEPathClassBase implements PVEPathEndpointInterface
{
    /**
     * Ceph constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'ceph/');
    }

    /**
     * Get the status of all ceph flags
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/flags
     * @param string $tokenId
     * @return Flags
     */
    public function flags(string $tokenId): Flags
    {
        return new Flags($this->getPve(), $this->getPathAdditional() . $tokenId . '/');
    }

    /**
     * Get ceph metadata.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/metadata
     * @return MetaData
     */
    public function metaData(): MetaData
    {
        return new MetaData($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get ceph status.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/status
     * @return Status
     */
    public function status(): Status
    {
        return new Status($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Cluster ceph index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

}