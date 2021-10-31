<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Config\Nodes;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Node
 * @package Proxmox\Api\Cluster\Config\Nodes
 */
class Node extends PVEPathClassBase
{

    /**
     * Node constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Adds a node to the cluster configuration. This call is for internal use.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/nodes/{node}
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

    /**
     * Removes a node from the cluster configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/nodes/{node}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}