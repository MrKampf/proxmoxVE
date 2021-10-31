<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster;

use Proxmox\Api\Cluster\Config\ApiVersion;
use Proxmox\Api\Cluster\Config\Join;
use Proxmox\Api\Cluster\Config\Nodes;
use Proxmox\Api\Cluster\Config\QDevice;
use Proxmox\Api\Cluster\Config\Totem;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Config
 * @package Proxmox\Api\Cluster
 */
class Config extends PVEPathClassBase
{
    /**
     * Config constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'config/');
    }

    /**
     * Adds a node to the cluster configuration. This call is for internal use.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/nodes/{node}
     * @return Nodes
     */
    public function nodes(): Nodes
    {
        return new Nodes($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Return the version of the cluster join API available on this node.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/apiversion
     * @return ApiVersion
     */
    public function apiVersion(): ApiVersion
    {
        return new ApiVersion($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Joins this node into an existing cluster. If no links are given, default to IP resolved by node's hostname on single link (fallback fails for clusters with multiple links).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/join
     * @return Join
     */
    public function join(): Join
    {
        return new Join($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get QDevice status
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/qdevice
     * @return QDevice
     */
    public function qDevice(): QDevice
    {
        return new QDevice($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get corosync totem protocol settings.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/totem
     * @return Totem
     */
    public function totem(): Totem
    {
        return new Totem($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Generate new cluster configuration. If no links given, default to local IP address as link0.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}