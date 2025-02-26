<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Sdn;

use Proxmox\Api\Cluster\Sdn\Zones\Zone;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Zones
 * @package Proxmox\Api\Nodes\Node\Sdn
 */
class Zones extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'zones/');
    }

    /**
     * Index of available pci methods
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/hardware/pci/{pciid}
     * @param string $zone
     * @return Zone
     */
    public function zone(string $zone): Zone
    {
        return new Zone($this->getPve(), $this->getPathAdditional() . $zone . '/');
    }

    /**
     * Get status for all zones.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/sdn/zones
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}