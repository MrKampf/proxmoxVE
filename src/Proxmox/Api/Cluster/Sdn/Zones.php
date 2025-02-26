<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Sdn;

use Proxmox\Api\Cluster\Sdn\Zones\Zone;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Zones
 * @package Proxmox\Api\Cluster\Sdn
 */
class Zones extends PVEPathClassBase
{
    /**
     * Zones constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'zones/');
    }

    /**
     * Read sdn zone configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/zones/{zone}
     * @param string $zone
     * @return Zone
     */
    public function zone(string $zone): Zone
    {
        return new Zone($this->getPve(), $this->getPathAdditional() . $zone . '/');
    }

    /**
     * SDN zones index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/zones
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Create a new sdn zone object.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/zones
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}