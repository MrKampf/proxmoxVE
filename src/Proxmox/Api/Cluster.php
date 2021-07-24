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
use Proxmox\Api\Cluster\Metrics;
use Proxmox\Api\Cluster\Replication;
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
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme
     * @return Acme
     */
    public function acme(): Acme
    {
        return new Acme($this->getPve(), $this->getPathAdditional());
    }

    /**
     * ACMEAccount index.
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup
     * @return Backup
     */
    public function backup(): Backup
    {
        return new Backup($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Index for backup info related endpoints
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup-info
     * @return BackupInfo
     */
    public function backupInfo(): BackupInfo
    {
        return new BackupInfo($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Cluster ceph index.
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/ceph
     * @return Ceph
     */
    public function ceph(): Ceph
    {
        return new Ceph($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config
     * @return Config
     */
    public function config(): Config
    {
        return new Config($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall
     * @return Firewall
     */
    public function firewall(): Firewall
    {
        return new Firewall($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha
     * @return Ha
     */
    public function ha(): Ha
    {
        return new Ha($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Metrics index.
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/metrics
     * @return Metrics
     */
    public function metrics(): Metrics
    {
        return new Metrics($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List replication jobs.
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/replication
     * @return Replication
     */
    public function replication(): Replication
    {
        return new Replication($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Cluster index.
     *
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}