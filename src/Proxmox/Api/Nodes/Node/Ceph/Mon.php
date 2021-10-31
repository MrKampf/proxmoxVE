<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Ceph;

use Proxmox\Api\Nodes\Node\Ceph\Mon\MonId;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Mon
 * @package Proxmox\Api\Nodes\Node\Ceph
 */
class Mon extends PVEPathClassBase
{

    /**
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'mon/');
    }

    /**
     * Get Ceph monitor list.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/mon
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create Ceph Monitor and Manager
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/mon/{monid}
     * @param string $monId
     * @return MonId
     */
    public function monId(string $monId): MonId
    {
        return new MonId($this->getPve(), $this->getPathAdditional() . $monId . '/');
    }
}