<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Ceph\Mon;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class MonId
 * @package Proxmox\Api\Nodes\Node\Ceph\Mon
 */
class MonId extends PVEPathClassBase
{

    /**
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Create Ceph Monitor and Manager
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/mon/{monid}
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

    /**
     * Destroy Ceph Monitor and Manager.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/mon/{monid}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}