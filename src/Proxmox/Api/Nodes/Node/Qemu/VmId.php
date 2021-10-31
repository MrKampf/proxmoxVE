<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Qemu;

use Proxmox\Api\Nodes\Node\Qemu\VmId\Agent;
use Proxmox\Api\Nodes\Node\Qemu\VmId\CloneVm;
use Proxmox\Api\Nodes\Node\Qemu\VmId\CloudInit;
use Proxmox\Api\Nodes\Node\Qemu\VmId\Config;
use Proxmox\Api\Nodes\Node\Qemu\VmId\Feature;
use Proxmox\Api\Nodes\Node\Qemu\VmId\Firewall;
use Proxmox\Api\Nodes\Node\Qemu\VmId\Migration;
use Proxmox\Api\Nodes\Node\Qemu\VmId\Monitor;
use Proxmox\Api\Nodes\Node\Qemu\VmId\MoveDisk;
use Proxmox\Api\Nodes\Node\Qemu\VmId\Pending;
use Proxmox\Api\Nodes\Node\Qemu\VmId\Resize;
use Proxmox\Api\Nodes\Node\Qemu\VmId\Rrd;
use Proxmox\Api\Nodes\Node\Qemu\VmId\RrdData;
use Proxmox\Api\Nodes\Node\Qemu\VmId\SendKey;
use Proxmox\Api\Nodes\Node\Qemu\VmId\Snapshot;
use Proxmox\Api\Nodes\Node\Qemu\VmId\SpiceProxy;
use Proxmox\Api\Nodes\Node\Qemu\VmId\Status;
use Proxmox\Api\Nodes\Node\Qemu\VmId\Template;
use Proxmox\Api\Nodes\Node\Qemu\VmId\Termproxy;
use Proxmox\Api\Nodes\Node\Qemu\VmId\Unlink;
use Proxmox\Api\Nodes\Node\Qemu\VmId\VncProxy;
use Proxmox\Api\Nodes\Node\Qemu\VmId\VncWebsocket;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class VmId
 * @package Proxmox\Api\Nodes\Node\Qemu
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
     * Qemu Agent command index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/agent
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Agent
     */
    public function agent(): Agent
    {
        return new Agent($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get the virtual machine configuration with pending configuration changes applied. Set the 'current' parameter to get the current configuration instead.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/cloudinit
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\CloudInit
     */
    public function cloudinit(): CloudInit
    {
        return new CloudInit($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/firewall
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Firewall
     */
    public function firewall(): Firewall
    {
        return new Firewall($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List all snapshots.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/snapshot
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Snapshot
     */
    public function snapshot(): Snapshot
    {
        return new Snapshot($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/status
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Status
     */
    public function status(): Status
    {
        return new Status($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Create a container clone/copy
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/clone
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\CloneVm
     */
    public function clone(): CloneVm
    {
        return new CloneVm($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get container configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/config
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Config
     */
    public function config(): Config
    {
        return new Config($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Check if feature for virtual machine is available.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/feature
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Feature
     */
    public function feature(): Feature
    {
        return new Feature($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Migrate the container to another node. Creates a new migration task.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/migration
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Migration
     */
    public function migration(): Migration
    {
        return new Migration($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Execute Qemu monitor commands.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/monitor
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Monitor
     */
    public function monitor(): Monitor
    {
        return new Monitor($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Move a rootfs-/mp-volume to a different storage
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/move_disk
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\MoveDisk
     */
    public function move_disk(): MoveDisk
    {
        return new MoveDisk($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get container configuration, including pending changes.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/pending
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Pending
     */
    public function pending(): Pending
    {
        return new Pending($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Resize a container mount point.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/resize
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Resize
     */
    public function resize(): Resize
    {
        return new Resize($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read VM RRD statistics (returns PNG)
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/rrd
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Rrd
     */
    public function rrd(): Rrd
    {
        return new Rrd($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read VM RRD statistics
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/rrddata
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\RrdData
     */
    public function rrddata(): RrdData
    {
        return new RrdData($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Send key event to virtual machine.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/sendkey
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\SendKey
     */
    public function sendkey(): SendKey
    {
        return new SendKey($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Returns a SPICE configuration to connect to the CT.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/spiceProxy
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\SpiceProxy
     */
    public function spiceproxy(): SpiceProxy
    {
        return new SpiceProxy($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Create a Template.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/template
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Template
     */
    public function template(): Template
    {
        return new Template($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Creates a TCP proxy connection.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/termproxy
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Termproxy
     */
    public function termproxy(): Termproxy
    {
        return new Termproxy($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Unlink/delete disk images.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}/unlink
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\Unlink
     */
    public function unlink(): Unlink
    {
        return new Unlink($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Creates a TCP VNC proxy connections.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/vncproxy
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\VncProxy
     */
    public function vncproxy(): VncProxy
    {
        return new VncProxy($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Opens a weksocket for VNC traffic.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/Qemu/{vmid}/vncwebsocket
     * @return \Proxmox\Api\Nodes\Node\Qemu\VmId\VncWebsocket
     */
    public function vncwebsocket(): VncWebsocket
    {
        return new VncWebsocket($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Destroy the VM and all used/owned volumes. Removes any VM specific permissions and firewall rules
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/qemu/{vmid}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}