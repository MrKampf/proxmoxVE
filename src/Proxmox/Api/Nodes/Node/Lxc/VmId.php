<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Lxc;

use Proxmox\Api\Nodes\Node\Lxc\VmId\CloneVm;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Config;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Feature;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Firewall;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Migration;
use Proxmox\Api\Nodes\Node\Lxc\VmId\MoveVolume;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Pending;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Resize;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Rrd;
use Proxmox\Api\Nodes\Node\Lxc\VmId\RrdData;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Snapshot;
use Proxmox\Api\Nodes\Node\Lxc\VmId\SpiceProxy;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Status;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Template;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Termproxy;
use Proxmox\Api\Nodes\Node\Lxc\VmId\VncProxy;
use Proxmox\Api\Nodes\Node\Lxc\VmId\VncWebsocket;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class VmId
 * @package Proxmox\Api\Nodes\Node\Lxc
 */
class VmId extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/firewall
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\Firewall
     */
    public function firewall(): Firewall
    {
        return new Firewall($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List all snapshots.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/snapshot
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\Snapshot
     */
    public function snapshot(): Snapshot
    {
        return new Snapshot($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/status
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\Status
     */
    public function status(): Status
    {
        return new Status($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Create a container clone/copy
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/clone
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\CloneVm
     */
    public function clone(): CloneVm
    {
        return new CloneVm($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get container configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/config
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\Config
     */
    public function config(): Config
    {
        return new Config($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Check if feature for virtual machine is available.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/feature
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\Feature
     */
    public function feature(): Feature
    {
        return new Feature($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Migrate the container to another node. Creates a new migration task.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/migration
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\Migration
     */
    public function migration(): Migration
    {
        return new Migration($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Move a rootfs-/mp-volume to a different storage
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/move_volume
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\MoveVolume
     */
    public function move_volume(): MoveVolume
    {
        return new MoveVolume($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get container configuration, including pending changes.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/pending
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\Pending
     */
    public function pending(): Pending
    {
        return new Pending($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Resize a container mount point.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/resize
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\Resize
     */
    public function resize(): Resize
    {
        return new Resize($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read VM RRD statistics (returns PNG)
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/rrd
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\Rrd
     */
    public function rrd(): Rrd
    {
        return new Rrd($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read VM RRD statistics
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/rrddata
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\RrdData
     */
    public function rrddata(): RrdData
    {
        return new RrdData($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Returns a SPICE configuration to connect to the CT.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/spiceProxy
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\SpiceProxy
     */
    public function spiceproxy(): SpiceProxy
    {
        return new SpiceProxy($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Create a Template.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/template
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\Template
     */
    public function template(): Template
    {
        return new Template($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Creates a TCP proxy connection.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/termproxy
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\Termproxy
     */
    public function termproxy(): Termproxy
    {
        return new Termproxy($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Creates a TCP VNC proxy connections.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/vncproxy
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\VncProxy
     */
    public function vncproxy(): VncProxy
    {
        return new VncProxy($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Opens a weksocket for VNC traffic.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/vncwebsocket
     * @return \Proxmox\Api\Nodes\Node\Lxc\VmId\VncWebsocket
     */
    public function vncwebsocket(): VncWebsocket
    {
        return new VncWebsocket($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Destroy the container (also delete all uses files).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}