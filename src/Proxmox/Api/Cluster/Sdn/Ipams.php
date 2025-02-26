<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Sdn;

use Proxmox\Api\Cluster\Sdn\Ipams\Ipam;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Ipams
 * @package Proxmox\Api\Cluster\Sdn
 */
class Ipams extends PVEPathClassBase
{
    /**
     * Ipams constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'ipams/');
    }

    /**
     * Read sdn dns configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/ipams
     * @param string $ipam
     * @return Ipam
     */
    public function ipam(string $ipam): Ipam
    {
        return new Ipam($this->getPve(), $this->getPathAdditional() . $ipam . '/');
    }

    /**
     * SDN ipams index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/ipams
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Create a new sdn ipam object.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/ipams
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}