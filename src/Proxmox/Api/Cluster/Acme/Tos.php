<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Acme;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Tos
 * @package Proxmox\Api\Cluster
 */
class Tos extends PVEPathClassBase
{
    /**
     * Tos constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'tos/');
    }

    /**
     * Retrieve ACME TermsOfService URL from CA.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/tos
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}