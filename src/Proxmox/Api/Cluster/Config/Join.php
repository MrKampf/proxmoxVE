<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Config;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Join
 * @package Proxmox\Api\Cluster\Config
 */
class Join extends PVEPathClassBase
{

    /**
     * Join constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'join/');
    }

    /**
     * Get information needed to join this cluster over the connected node.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/join
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Joins this node into an existing cluster. If no links are given, default to IP resolved by node's hostname on single link (fallback fails for clusters with multiple links).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/join
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}