<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Ceph\Osd;

use Proxmox\Api\Nodes\Node\Ceph\Osd\OsdId\In;
use Proxmox\Api\Nodes\Node\Ceph\Osd\OsdId\Out;
use Proxmox\Api\Nodes\Node\Ceph\Osd\OsdId\Scrub;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class OsdId
 * @package Proxmox\Api\Nodes\Node\Ceph\Osd
 */
class OsdId extends PVEPathClassBase
{

    /**
     * @param \Proxmox\PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * ceph osd in
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/osd/{osdid}/in
     * @return In
     */
    public function in(): In
    {
        return new In($this->getPve(), $this->getPathAdditional());
    }

    /**
     * ceph osd out
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/osd/{osdid}/out
     * @return Out
     */
    public function out(): Out
    {
        return new Out($this->getPve(), $this->getPathAdditional());
    }

    /**
     * ceph osd scrub
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/osd/{osdid}/scrub
     * @return Scrub
     */
    public function scrub(): Scrub
    {
        return new Scrub($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Destroy OSD
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/osd/{osdid}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}