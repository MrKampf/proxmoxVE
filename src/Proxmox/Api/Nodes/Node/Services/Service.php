<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Services;

use Proxmox\Api\Nodes\Node\Services\Service\Reload;
use Proxmox\Api\Nodes\Node\Services\Service\Restart;
use Proxmox\Api\Nodes\Node\Services\Service\Start;
use Proxmox\Api\Nodes\Node\Services\Service\State;
use Proxmox\Api\Nodes\Node\Services\Service\Stop;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Service
 * @package Proxmox\Api\Nodes\Node\Services
 */
class Service extends PVEPathClassBase
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
     * Reload service. Falls back to restart if service cannot be reloaded.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/services/{service}/reload
     * @return \Proxmox\Api\Nodes\Node\Services\Service\Reload
     */
    public function reload(): Reload
    {
        return new Reload($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Hard restart service. Use reload if you want to reduce interruptions.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/services/{service}/restart
     * @return \Proxmox\Api\Nodes\Node\Services\Service\Restart
     */
    public function restart(): Restart
    {
        return new Restart($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Start service.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/services/{service}/start
     * @return \Proxmox\Api\Nodes\Node\Services\Service\Start
     */
    public function start(): Start
    {
        return new Start($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read service properties
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/services/{service}/state
     * @return \Proxmox\Api\Nodes\Node\Services\Service\State
     */
    public function state(): State
    {
        return new State($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Stop service.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/services/{service}/stop
     * @return \Proxmox\Api\Nodes\Node\Services\Service\Stop
     */
    public function stop(): Stop
    {
        return new Stop($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/services/{service}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}