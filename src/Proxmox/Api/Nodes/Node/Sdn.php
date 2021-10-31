<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Api\Nodes\Node\Sdn\Zones;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Sdn
 * @package Proxmox\Api\Nodes\Node
 */
class Sdn extends PVEPathClassBase
{
    /**
     * Apt constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'sdn/');
    }

    /**
     * Get status for all zones.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/sdn/zones
     * @return \Proxmox\Api\Nodes\Node\Sdn\Zones
     */
    public function zones(): Zones
    {
        return new Zones($this->getPve(), $this->getPathAdditional());
    }

    /**
     * SDN index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/sdn
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}