<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Api\Nodes\Node\Scan\Cifs;
use Proxmox\Api\Nodes\Node\Scan\Glusterfs;
use Proxmox\Api\Nodes\Node\Scan\Iscsi;
use Proxmox\Api\Nodes\Node\Scan\Lvm;
use Proxmox\Api\Nodes\Node\Scan\Lvmthin;
use Proxmox\Api\Nodes\Node\Scan\Nfs;
use Proxmox\Api\Nodes\Node\Scan\Pbs;
use Proxmox\Api\Nodes\Node\Scan\Zfs;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Scan
 * @package Proxmox\Api\Nodes\Node
 */
class Scan extends PVEPathClassBase
{
    /**
     * Apt constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'scan/');
    }

    /**
     * Scan remote CIFS server.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/scan/cifs
     * @return \Proxmox\Api\Nodes\Node\Scan\Cifs
     */
    public function cifs(): Cifs
    {
        return new Cifs($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Scan remote GlusterFS server.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/scan/glusterfs
     * @return \Proxmox\Api\Nodes\Node\Scan\Glusterfs
     */
    public function glusterfs(): Glusterfs
    {
        return new Glusterfs($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Scan remote iSCSI server.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/scan/iscsi
     * @return \Proxmox\Api\Nodes\Node\Scan\Iscsi
     */
    public function iscsi(): Iscsi
    {
        return new Iscsi($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List local LVM volume groups.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/scan/lvm
     * @return \Proxmox\Api\Nodes\Node\Scan\Lvm
     */
    public function lvm(): Lvm
    {
        return new Lvm($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List local LVM Thin Pools.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/scan/lvmthin
     * @return \Proxmox\Api\Nodes\Node\Scan\Lvmthin
     */
    public function lvmthin(): Lvmthin
    {
        return new Lvmthin($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Scan remote NFS server.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/scan/nfs
     * @return \Proxmox\Api\Nodes\Node\Scan\Nfs
     */
    public function nfs(): Nfs
    {
        return new Nfs($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Scan remote Proxmox Backup Server.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/scan/pbs
     * @return \Proxmox\Api\Nodes\Node\Scan\Pbs
     */
    public function pbs(): Pbs
    {
        return new Pbs($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Scan zfs pool list on local node.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/scan/zfs
     * @return \Proxmox\Api\Nodes\Node\Scan\Zfs
     */
    public function zfs(): Zfs
    {
        return new Zfs($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Index of available scan methods
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/scan
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}