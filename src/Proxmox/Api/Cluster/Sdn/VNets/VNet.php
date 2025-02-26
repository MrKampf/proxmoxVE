<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Sdn\VNets;

use Proxmox\Api\Cluster\Sdn\VNets\VNet\Subnets;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Vnet
 * @package Proxmox\Api\Cluster\Sdn\VNets
 */
class VNet extends PVEPathClassBase
{

    /**
     * Vnet constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * SDN subnets index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/vnets/{vnet}/subnets
     * @return Subnets
     */
    public function subnets(): Subnets
    {
        return new Subnets($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read sdn vnet configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/vnets/{vnet}
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Update sdn vnet object configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/vnets/{vnet}
     * @param array $params
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete sdn vnet object configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/vnets/{vnet}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}