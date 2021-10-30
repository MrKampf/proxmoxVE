<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Api\Nodes\Node\Lxc\VmId;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Lxc
 * @package Proxmox\Api\Nodes\Node
 */
class Lxc extends PVEPathClassBase
{
    /**
     * Ceph constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'lxc/');
    }

    /**
     * Directory index
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}
     * @param string $vmId
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId
     */
    public function vmId(string $vmId): VmId
    {
        return new VmId($this->getPve(), $this->getPathAdditional() . $vmId . '/');
    }

    /**
     * LXC container index (per node).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create or restore a container.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}