<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster;

use Proxmox\Api\Cluster\Metrics\Server;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Metrics
 * @package Proxmox\Api\Cluster
 */
class Metrics extends PVEPathClassBase
{
    /**
     * Metrics constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'metrics/');
    }

    /**
     * List configured metric servers.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/metrics/server
     * @return Server
     */
    public function server(): Server
    {
        return new Server($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Metrics index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/metrics
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}