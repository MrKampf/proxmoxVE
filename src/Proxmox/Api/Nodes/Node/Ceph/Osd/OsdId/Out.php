<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Ceph\Osd\OsdId;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Out
 * @package Proxmox\Api\Nodes\Node\Ceph\Osd
 */
class Out extends PVEPathClassBase
{

    /**
     * @param \Proxmox\PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'out/');
    }

    /**
     * ceph osd out
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/osd/{osdid}/out
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}