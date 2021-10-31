<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Qemu\VmId\Snapshot\Snapname;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Rollback
 * @package Proxmox\Api\Nodes\Node\Qemu\VmId\Snapshot\Snapname
 */
class Rollback extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'rollback/');
    }

    /**
     * Rollback LXC state to specified snapshot.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/snapshot/{snapname}/rollback
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}