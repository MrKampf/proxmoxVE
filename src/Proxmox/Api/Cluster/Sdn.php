<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster;

use Proxmox\Api\Cluster\Sdn\Controllers;
use Proxmox\Api\Cluster\Sdn\Dns;
use Proxmox\Api\Cluster\Sdn\Ipams;
use Proxmox\Api\Cluster\Sdn\VNets;
use Proxmox\Api\Cluster\Sdn\Zones;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Sdn
 * @package Proxmox\Api\Cluster
 */
class Sdn extends PVEPathClassBase
{
    /**
     * Sdn constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'sdn/');
    }

    /**
     * SDN controllers index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/controllers
     * @return Controllers
     */
    public function controllers(): Controllers
    {
        return new Controllers($this->getPve(), $this->getPathAdditional());
    }

    /**
     * SDN dns index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/dns/{dns}
     * @return Dns
     */
    public function dns(): Dns
    {
        return new Dns($this->getPve(), $this->getPathAdditional());
    }

    /**
     * SDN ipams index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/ipams
     * @return Ipams
     */
    public function ipams(): Ipams
    {
        return new Ipams($this->getPve(), $this->getPathAdditional());
    }

    /**
     * SDN vnets index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/vnets
     * @return VNets
     */
    public function vNets(): VNets
    {
        return new VNets($this->getPve(), $this->getPathAdditional());
    }

    /**
     * SDN zones index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/zones
     * @return Zones
     */
    public function zones(): Zones
    {
        return new Zones($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Apply sdn controller changes && reload.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

}