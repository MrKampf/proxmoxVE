<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Scan;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Zfs
 * @package Proxmox\Api\Nodes\Node\Scan
 */
class Zfs extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'zfs/');
    }

    /**
     * Scan zfs pool list on local node.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/scan/zfs
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}