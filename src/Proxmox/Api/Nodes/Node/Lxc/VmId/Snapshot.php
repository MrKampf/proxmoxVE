<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Lxc\VmId;

use Proxmox\Api\Nodes\Node\Lxc\VmId\Snapshot\Snapname;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Snapshot
 * @package Proxmox\Api\Nodes\Node\Lxc\VmId
 */
class Snapshot extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'snapshot/');
    }

    /**
     * Read network device configuration
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/network/{iface}
     * @param string $snapname
     * @return Snapname
     */
    public function snapname(string $snapname): Snapname
    {
        return new Snapname($this->getPve(), $this->getPathAdditional() . $snapname . '/');
    }

    /**
     * List all snapshots.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/snapshot
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Snapshot a container.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/snapshot
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}