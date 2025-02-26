<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Api\Nodes\Node\Disks\Directory;
use Proxmox\Api\Nodes\Node\Disks\Initgpt;
use Proxmox\Api\Nodes\Node\Disks\Lists;
use Proxmox\Api\Nodes\Node\Disks\Lvm;
use Proxmox\Api\Nodes\Node\Disks\Lvmthin;
use Proxmox\Api\Nodes\Node\Disks\Smart;
use Proxmox\Api\Nodes\Node\Disks\Wipedisk;
use Proxmox\Api\Nodes\Node\Disks\Zfs;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Disks
 * @package Proxmox\Api\Nodes\Node
 */
class Disks extends PVEPathClassBase
{
    /**
     * Ceph constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'disks/');
    }

    /**
     * List Zpools.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/zfs
     * @return Zfs
     */
    public function zfs(): Zfs
    {
        return new Zfs($this->getPve(), $this->getPathAdditional());
    }

    /**
     * PVE Managed Directory storages.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/directory
     * @return Directory
     */
    public function directory(): Directory
    {
        return new Directory($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Initialize Disk with GPT
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/initgpt
     * @return Initgpt
     */
    public function initgpt(): Initgpt
    {
        return new Initgpt($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List local disks.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/list
     * @return Lists
     */
    public function list(): Lists
    {
        return new Lists($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List LVM Volume Groups
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/lvm
     * @return Lvm
     */
    public function lvm(): Lvm
    {
        return new Lvm($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List LVM thinpools
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/lvmthin
     * @return Lvmthin
     */
    public function lvmthin(): Lvmthin
    {
        return new Lvmthin($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get SMART Health of a disk.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/smart
     * @return Smart
     */
    public function smart(): Smart
    {
        return new Smart($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Wipe a disk or partition.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/wipedisk
     * @return Wipedisk
     */
    public function wipedisk(): Wipedisk
    {
        return new Wipedisk($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Node index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

}