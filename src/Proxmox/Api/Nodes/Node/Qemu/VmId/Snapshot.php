<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Qemu\VmId;

use Proxmox\Api\Nodes\Node\Qemu\VmId\Snapshot\Snapname;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Snapshot
 * @package Proxmox\Api\Nodes\Node\Qemu\VmId
 */
class Snapshot extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'snapshot/');
    }

    /**
     * Read network device configuration
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/network/{iface}
     * @param string $snapname
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Snapshot\Snapname
     */
    public function snapname(string $snapname): Snapname
    {
        return new Snapname($this->getPve(), $this->getPathAdditional() . $snapname . '/');
    }

    /**
     * List all snapshots.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/snapshot
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Snapshot a container.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/snapshot
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}