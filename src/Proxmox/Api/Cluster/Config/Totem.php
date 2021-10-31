<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Config;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Totem
 * @package Proxmox\Api\Cluster\Config
 */
class Totem extends PVEPathClassBase
{

    /**
     * Totem constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'totem/');
    }

    /**
     * Get corosync totem protocol settings.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/totem
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}