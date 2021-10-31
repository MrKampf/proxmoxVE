<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster;

use Proxmox\Api\Cluster\Replication\Id;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Replication
 * @package Proxmox\Api\Cluster
 */
class Replication extends PVEPathClassBase
{
    /**
     * Replication constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'replication/');
    }

    /**
     * Read replication job configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/replication/{id}
     * @param string $id
     * @return Id
     */
    public function id(string $id): Id
    {
        return new Id($this->getPve(), $this->getPathAdditional() . $id . '/');
    }

    /**
     * List replication jobs.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/replication
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create a new replication job
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/replication
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}