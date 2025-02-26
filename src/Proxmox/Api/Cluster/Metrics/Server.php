<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Metrics;

use Proxmox\Api\Cluster\Metrics\Server\Id;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Server
 * @package Proxmox\Api\Cluster
 */
class Server extends PVEPathClassBase
{
    /**
     * Server constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'server/');
    }

    /**
     * Read metric server configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/metrics/server/{id}
     * @param string $id
     * @return Id
     */
    public function id(string $id): Id
    {
        return new Id($this->getPve(), $this->getPathAdditional() . $id . '/');
    }

    /**
     * List configured metric servers.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/metrics/server
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

}