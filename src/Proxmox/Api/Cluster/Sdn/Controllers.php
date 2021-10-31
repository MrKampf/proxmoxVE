<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Sdn;

use Proxmox\Api\Cluster\Sdn\Controllers\Controller;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Controllers
 * @package Proxmox\Api\Cluster\Sdn
 */
class Controllers extends PVEPathClassBase
{
    /**
     * Controllers constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'controllers/');
    }

    /**
     * Read sdn controller configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/controllers/{controller}
     * @param string $controller
     * @return Controller
     */
    public function controller(string $controller): Controller
    {
        return new Controller($this->getPve(), $this->getPathAdditional() . $controller . '/');
    }

    /**
     * SDN controllers index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/controllers
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create a new sdn controller object.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/controllers
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}