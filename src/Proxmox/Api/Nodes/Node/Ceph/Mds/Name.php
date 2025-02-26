<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Ceph\Mds;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Name
 * @package Proxmox\Api\Nodes\Node\Ceph\Mds
 */
class Name extends PVEPathClassBase
{

    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Create a Ceph filesystem
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/mds/{name}
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

    /**
     * Destroy Ceph Metadata Server
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/mds/{name}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}