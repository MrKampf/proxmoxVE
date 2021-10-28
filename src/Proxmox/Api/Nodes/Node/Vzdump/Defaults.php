<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Vzdump;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Defaults
 * @package Proxmox\Api\Nodes\Node\Vzdump
 */
class Defaults extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'defaults/');
    }

    /**
     * Get the currently configured vzdump defaults.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/defaults
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}