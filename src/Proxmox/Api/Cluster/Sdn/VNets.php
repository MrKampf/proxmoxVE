<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Sdn;

use Proxmox\Api\Cluster\Sdn\VNets\VNet;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class VNets
 * @package Proxmox\Api\Cluster\Sdn
 */
class VNets extends PVEPathClassBase
{
    /**
     * VNets constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'vnets/');
    }

    /**
     * Read sdn vnet configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/vnets/{vnet}
     * @param string $vnet
     * @return VNet
     */
    public function vnet(string $vnet): VNet
    {
        return new VNet($this->getPve(), $this->getPathAdditional() . $vnet . '/');
    }

    /**
     * SDN vnets index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/vnets
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Create a new sdn vnet object.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/vnets
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}