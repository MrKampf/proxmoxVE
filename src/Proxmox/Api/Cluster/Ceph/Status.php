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
 * Class Status
 * @package Proxmox\Api\Cluster\Ceph
 */
class Status extends PVEPathClassBase implements PVEPathEndpointInterface
{
    /**
     * Status constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'status/');
    }

    /**
     * Get ceph status.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph/status
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}