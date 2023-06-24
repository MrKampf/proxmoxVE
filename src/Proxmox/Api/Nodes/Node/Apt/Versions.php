<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Apt;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Versions
 * @package Proxmox\Api\Nodes\Node\Apt
 */
class Versions extends PVEPathClassBase
{
    /**
     * Versions constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'versions/');
    }

    /**
     * Get package information for important Proxmox packages.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/apt/versions
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}