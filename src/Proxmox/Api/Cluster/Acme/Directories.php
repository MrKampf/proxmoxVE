<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Acme;

use Proxmox\Helper\Interfaces\PVEPathClassInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Directories
 * @package Proxmox\Api\Cluster
 */
class Directories extends PVEPathClassBase implements PVEPathClassInterface
{
    /**
     * Directories constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'directories/');
    }

    /**
     * Get named known ACME directory endpoints.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/directories
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}