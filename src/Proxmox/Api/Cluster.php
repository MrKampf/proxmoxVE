<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api;

use Proxmox\Api\Cluster\Acme;
use Proxmox\Api\Cluster\Backup;
use Proxmox\Api\Cluster\BackupInfo;
use Proxmox\Api\Cluster\Ceph;
use Proxmox\Api\Cluster\Config;
use Proxmox\Api\Cluster\Firewall;
use Proxmox\Api\Cluster\Ha;
use Proxmox\Api\Cluster\Log;
use Proxmox\Api\Cluster\Metrics;
use Proxmox\Api\Cluster\NextId;
use Proxmox\Api\Cluster\Options;
use Proxmox\Api\Cluster\Replication;
use Proxmox\Api\Cluster\Resources;
use Proxmox\Api\Cluster\Sdn;
use Proxmox\Api\Cluster\Status;
use Proxmox\Api\Cluster\Tasks;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Cluster
 * @package Proxmox\Api
 */
class Cluster extends PVEPathClassBase
{

    /**
     * Cluster constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'cluster/');
    }

    /**
     * ACMEAccount index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme
     * @return Acme
     */
    public function acme(): Acme
    {
        return new Acme($this->getPve(), $this->getPathAdditional());
    }

    /**
     * ACMEAccount index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup
     * @return Backup
     */
    public function backup(): Backup
    {
        return new Backup($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Index for backup info related endpoints
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup-info
     * @return BackupInfo
     */
    public function backupInfo(): BackupInfo
    {
        return new BackupInfo($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Cluster ceph index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph
     * @return Ceph
     */
    public function ceph(): Ceph
    {
        return new Ceph($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config
     * @return Config
     */
    public function config(): Config
    {
        return new Config($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall
     * @return Firewall
     */
    public function firewall(): Firewall
    {
        return new Firewall($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha
     * @return Ha
     */
    public function ha(): Ha
    {
        return new Ha($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Metrics index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/metrics
     * @return Metrics
     */
    public function metrics(): Metrics
    {
        return new Metrics($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List replication jobs.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/replication
     * @return Replication
     */
    public function replication(): Replication
    {
        return new Replication($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn
     * @return Sdn
     */
    public function sdn(): Sdn
    {
        return new Sdn($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read cluster log
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/log
     * @return Log
     */
    public function log(): Log
    {
        return new Log($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get next free VMID. If you pass an VMID it will raise an error if the ID is already used.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/nextid
     * @return NextId
     */
    public function nextId(): NextId
    {
        return new NextId($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get datacenter options.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/options
     * @return Options
     */
    public function options(): Options
    {
        return new Options($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Resources index (cluster wide).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/resources
     * @return Resources
     */
    public function resources(): Resources
    {
        return new Resources($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get cluster status information.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/status
     * @return Status
     */
    public function status(): Status
    {
        return new Status($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List recent tasks (cluster wide).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/tasks
     * @return Tasks
     */
    public function tasks(): Tasks
    {
        return new Tasks($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Cluster index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}