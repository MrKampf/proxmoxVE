<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Certificates;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Info
 * @package Proxmox\Api\Nodes\Node\Certificates
 */
class Info extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'info/');
    }

    /**
     * Get information about node's certificates.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/certificates/info
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}