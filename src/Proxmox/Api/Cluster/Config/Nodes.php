<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Config;

use Proxmox\Api\Cluster\Config\Nodes\Node;
use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Nodes
 * @package Proxmox\Api\Cluster\Config
 */
class Nodes extends PVEPathClassBase implements PVEPathEndpointInterface
{

    /**
     * Nodes constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'nodes/');
    }

    /**
     * Adds a node to the cluster configuration. This call is for internal use.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/nodes/{node}
     * @param string $node
     * @return Node
     */
    public function node(string $node): Node
    {
        return new Node($this->getPve(), $this->getPathAdditional() . $node . '/');
    }

    /**
     * Corosync node list.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/nodes
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

}