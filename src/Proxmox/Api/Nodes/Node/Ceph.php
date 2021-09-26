<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Ceph
 * @package Proxmox\Api\Nodes\Node
 */
class Ceph extends PVEPathClassBase
{
    /**
     * Ceph constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'ceph/');
    }

    /**
     * Directory index.
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}