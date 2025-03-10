<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Sdn\VNets\VNet;

use Proxmox\Api\Cluster\Sdn\VNets\VNet\Subnets\Subnet;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Subnets
 * @package Proxmox\Api\Cluster\Sdn\VNets\VNet
 */
class Subnets extends PVEPathClassBase
{
    /**
     * Subnets constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'subnets/');
    }

    /**
     * Read sdn subnet configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/vnets/{vnet}/subnets/{subnet}
     * @param string $subnet
     * @return Subnet
     */
    public function subnet(string $subnet): Subnet
    {
        return new Subnet($this->getPve(), $this->getPathAdditional() . $subnet . '/');
    }

    /**
     * SDN subnets index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/vnets/{vnet}/subnets
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Create a new sdn subnet object.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/vnets/{vnet}/subnets
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}