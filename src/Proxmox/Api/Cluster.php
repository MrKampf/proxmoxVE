<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api;

use Proxmox\Api\Cluster\Acme;
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