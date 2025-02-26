<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Disks;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Lvmthin
 * @package Proxmox\Api\Nodes\Node\Disks
 */
class Lvmthin extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'lvmthin/');
    }

    /**
     * List LVM thinpools
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/lvmthin
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Create an LVM thinpool
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/lvmthin
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}