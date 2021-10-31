<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Sdn\Controllers;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Controller
 * @package Proxmox\Api\Cluster\Sdn\Controllers
 */
class Controller extends PVEPathClassBase
{
    /**
     * Controller constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Read sdn controller configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/controllers/{controller}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update sdn controller object configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/controllers/{controller}
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete sdn controller object configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/controllers/{controller}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}