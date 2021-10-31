<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Apt;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Changelog
 * @package Proxmox\Api\Nodes\Node\Apt
 */
class Changelog extends PVEPathClassBase
{
    /**
     * Changelog constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'changelog/');
    }

    /**
     * Get package changelogs.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/apt/changelog
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}