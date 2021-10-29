<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes;

use Proxmox\Api\Nodes\Node\Apt;
use Proxmox\Api\Nodes\Node\Capabilities;
use Proxmox\Api\Nodes\Node\Ceph;
use Proxmox\Api\Nodes\Node\Certificates;
use Proxmox\Api\Nodes\Node\Disks;
use Proxmox\Api\Nodes\Node\Firewall;
use Proxmox\Api\Nodes\Node\Hardware;
use Proxmox\Api\Nodes\Node\Tasks;
use Proxmox\Api\Nodes\Node\Vzdump;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Node
 * @package Proxmox\Api\Nodes
 */
class Node extends PVEPathClassBase
{
    /**
     * Node constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Directory index for apt (Advanced Package Tool).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/apt
     * @return Apt
     */
    public function apt(): Apt
    {
        return new Apt($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Node capabilities index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/capabilities
     * @return Capabilities
     */
    public function capabilities(): Capabilities
    {
        return new Capabilities($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph
     * @return Ceph
     */
    public function ceph(): Ceph
    {
        return new Ceph($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Node index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/certificates
     * @return Certificates
     */
    public function certificates(): Certificates
    {
        return new Certificates($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Node index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks
     * @return Disks
     */
    public function disks(): Disks
    {
        return new Disks($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/firewall
     * @return \Proxmox\Api\Nodes\Node\Firewall
     */
    public function firewall(): Firewall
    {
        return new Firewall($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Index of hardware types
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/hardware
     * @return \Proxmox\Api\Nodes\Node\Hardware
     */
    public function hardware(): Hardware
    {
        return new Hardware($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read task list for one node (finished tasks).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/tasks
     * @return \Proxmox\Api\Nodes\Node\Tasks
     */
    public function tasks(): Tasks
    {
        return new Tasks($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Create backup.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/vzdump
     * @return Vzdump
     */
    public function vzdump(): Vzdump
    {
        return new Vzdump($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Node index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}