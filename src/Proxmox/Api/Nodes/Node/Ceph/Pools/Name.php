<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Ceph\Pools;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Name
 * @package Proxmox\Api\Nodes\Node\Ceph\Pools
 */
class Name extends PVEPathClassBase
{

    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * List pool settings.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/pools/{name}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Change POOL settings
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/pools/{name}
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Destroy pool
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/pools/{name}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}