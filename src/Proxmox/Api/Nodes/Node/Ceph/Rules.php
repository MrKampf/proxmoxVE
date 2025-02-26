<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Ceph;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Rules
 * @package Proxmox\Api\Nodes\Node\Ceph
 */
class Rules extends PVEPathClassBase
{
    /**
     * Config constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'rules/');
    }

    /**
     * List ceph rules.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/rules
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}