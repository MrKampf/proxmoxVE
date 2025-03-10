<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Metrics\Server;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Id
 * @package Proxmox\Api\Cluster\Metrics\Server
 */
class Id extends PVEPathClassBase
{
    /**
     * Id constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Read metric server configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/metrics/server/{id}
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Update metric server configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/metrics/server/{id}
     * @param array $params
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Create a new external metric server config
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/metrics/server/{id}
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

    /**
     * Remove Metric server.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/metrics/server/{id}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}