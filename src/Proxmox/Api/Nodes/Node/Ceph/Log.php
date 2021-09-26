<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Ceph;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Log
 * @package Proxmox\Api\Nodes\Node\Ceph
 */
class Log extends PVEPathClassBase
{
    /**
     * Config constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'log/');
    }

    /**
     * Read ceph log
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/log
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}