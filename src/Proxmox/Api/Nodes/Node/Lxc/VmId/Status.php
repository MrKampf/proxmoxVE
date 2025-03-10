<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Lxc\VmId;

use Proxmox\Api\Nodes\Node\Lxc\VmId\Status\Current;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Status\Reboot;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Status\Resume;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Status\Shutdown;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Status\Start;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Status\Stop;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Status\Suspend;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Status
 * @package Proxmox\Api\Nodes\Node\Lxc\VmId
 */
class Status extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'status/');
    }

    /**
     * Get virtual machine status.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/status/current
     * @return Current
     */
    public function current(): Current
    {
        return new Current($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Reboot the container by shutting it down, and starting it again. Applies pending changes.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/status/reboot
     * @return Reboot
     */
    public function reboot(): Reboot
    {
        return new Reboot($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Resume the container.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/status/resume
     * @return Resume
     */
    public function resume(): Resume
    {
        return new Resume($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Shutdown the container. This will trigger a clean shutdown of the container, see lxc-stop(1) for details.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/status/shutdown
     * @return Shutdown
     */
    public function shutdown(): Shutdown
    {
        return new Shutdown($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Start the container.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/status/start
     * @return Start
     */
    public function start(): Start
    {
        return new Start($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Stop the container. This will abruptly stop all processes running in the container.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/status/stop
     * @return Stop
     */
    public function stop(): Stop
    {
        return new Stop($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Suspend the container.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/status/suspend
     * @return Suspend
     */
    public function suspend(): Suspend
    {
        return new Suspend($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/status
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}