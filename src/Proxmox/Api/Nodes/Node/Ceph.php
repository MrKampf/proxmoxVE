<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Api\Nodes\Node\Ceph\Config;
use Proxmox\Api\Nodes\Node\Ceph\ConfigDb;
use Proxmox\Api\Nodes\Node\Ceph\Crush;
use Proxmox\Api\Nodes\Node\Ceph\Fs;
use Proxmox\Api\Nodes\Node\Ceph\Init;
use Proxmox\Api\Nodes\Node\Ceph\Log;
use Proxmox\Api\Nodes\Node\Ceph\Mds;
use Proxmox\Api\Nodes\Node\Ceph\Mgr;
use Proxmox\Api\Nodes\Node\Ceph\Mon;
use Proxmox\Api\Nodes\Node\Ceph\Osd;
use Proxmox\Api\Nodes\Node\Ceph\Pools;
use Proxmox\Api\Nodes\Node\Ceph\Restart;
use Proxmox\Api\Nodes\Node\Ceph\Rules;
use Proxmox\Api\Nodes\Node\Ceph\Start;
use Proxmox\Api\Nodes\Node\Ceph\Status;
use Proxmox\Api\Nodes\Node\Ceph\Stop;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Ceph
 * @package Proxmox\Api\Nodes\Node
 */
class Ceph extends PVEPathClassBase
{
    /**
     * Ceph constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'ceph/');
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/fs
     * @return Fs
     */
    public function fs(): Fs
    {
        return new Fs($this->getPve(), $this->getPathAdditional());
    }

    /**
     * MDS directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/mds
     * @return Mds
     */
    public function mds(): Mds
    {
        return new Mds($this->getPve(), $this->getPathAdditional());
    }

    /**
     * MGR directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/mgr
     * @return Mgr
     */
    public function mgr(): Mgr
    {
        return new Mgr($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get Ceph monitor list.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/mon
     * @return Mon
     */
    public function mon(): Mon
    {
        return new Mon($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get Ceph osd list/tree.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/osd
     * @return Osd
     */
    public function osd(): Osd
    {
        return new Osd($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List all pools.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/pools
     * @return Pools
     */
    public function pools(): Pools
    {
        return new Pools($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get Ceph configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/config
     * @return Config
     */
    public function config(): Config
    {
        return new Config($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get Ceph configuration database.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/pools
     * @return ConfigDb
     */
    public function configDb(): ConfigDb
    {
        return new ConfigDb($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get OSD crush map
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/crush
     * @return Crush
     */
    public function crush(): Crush
    {
        return new Crush($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Create initial ceph default configuration and setup symlinks.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/init
     * @return Init
     */
    public function init(): Init
    {
        return new Init($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read ceph log
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/log
     * @return Log
     */
    public function log(): Log
    {
        return new Log($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Restart ceph services.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/restart
     * @return Restart
     */
    public function restart(): Restart
    {
        return new Restart($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List ceph rules.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/rules
     * @return Rules
     */
    public function rules(): Rules
    {
        return new Rules($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Start ceph services.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/start
     * @return Start
     */
    public function start(): Start
    {
        return new Start($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get ceph status.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/status
     * @return Status
     */
    public function status(): Status
    {
        return new Status($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Stop ceph services.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/stop
     * @return Stop
     */
    public function stop(): Stop
    {
        return new Stop($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}