<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Ceph\Osd\OsdId;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class In
 * @package Proxmox\Api\Nodes\Node\Ceph\Osd
 */
class In extends PVEPathClassBase
{

    /**
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'in/');
    }

    /**
     * ceph osd in
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/osd/{osdid}/in
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}