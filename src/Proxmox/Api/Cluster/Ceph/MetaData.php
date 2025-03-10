<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Ceph;

use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class MetaData
 * @package Proxmox\Api\Cluster\Ceph
 */
class MetaData extends PVEPathClassBase implements PVEPathEndpointInterface
{
    /**
     * MetaData constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'metadata/');
    }

    /**
     * Get ceph metadata.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/metadata
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}