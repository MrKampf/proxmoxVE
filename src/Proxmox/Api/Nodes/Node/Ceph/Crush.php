<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Ceph;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Crush
 * @package Proxmox\Api\Nodes\Node\Ceph
 */
class Crush extends PVEPathClassBase
{
    /**
     * Config constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'crush/');
    }

    /**
     * Get OSD crush map
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/crush
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}