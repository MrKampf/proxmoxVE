<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Ceph;

use Proxmox\Api\Nodes\Node\Ceph\Pools\Name;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Pools
 * @package Proxmox\Api\Nodes\Node\Ceph
 */
class Pools extends PVEPathClassBase
{

    /**
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'pools/');
    }

    /**
     * Get Ceph osd list/tree.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/pools
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create OSD
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/pools
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

    /**
     * Destroy OSD
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/pools/{name}
     * @param string $name
     * @return Name
     */
    public function name(string $name): Name
    {
        return new Name($this->getPve(), $this->getPathAdditional() . $name . '/');
    }
}