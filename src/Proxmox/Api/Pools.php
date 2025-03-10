<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api;

use Proxmox\API;
use Proxmox\Api\Pools\PoolId;
use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Pools
 * @package Proxmox\Api
 */
class Pools extends PVEPathClassBase implements PVEPathEndpointInterface
{

    /**
     * Pools constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'pools/');
    }

    /**
     * Get pool configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools/{poolid}
     * @param string $poolId
     * @return PoolId
     */
    public function poolId(string $poolId): PoolId
    {
        return new PoolId($this->getPve(), $this->getPathAdditional() . $poolId . '/');
    }

    /**
     * Pool index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Create new pool.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}