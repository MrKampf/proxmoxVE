<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Pools;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class PoolId
 * @package Proxmox\Api\Pools
 */
class PoolId extends PVEPathClassBase
{

    /**
     * Access constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Get pool configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools/{poolid}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update pool data.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools/{poolid}
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete pool.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools/{poolid}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}