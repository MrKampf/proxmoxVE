<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api;

use Proxmox\Api\Nodes\Node;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Nodes
 * @package Proxmox\Api
 */
class Nodes extends PVEPathClassBase
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
     * Node index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}
     * @param string $node
     * @return Node
     */
    public function node(string $node): Node
    {
        return new Node($this->getPve(), $this->getPathAdditional() . $node . '/');
    }

    /**
     * Cluster node index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

}