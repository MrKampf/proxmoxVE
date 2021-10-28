<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Disks;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Smart
 * @package Proxmox\Api\Nodes\Node\Disks
 */
class Smart extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'smart/');
    }

    /**
     * Get SMART Health of a disk.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/smart
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}