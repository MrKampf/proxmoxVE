<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Firewall;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Options
 * @package Proxmox\Api\Cluster\Firewall
 */
class Options extends PVEPathClassBase
{

    /**
     * Options constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'options/');
    }

    /**
     * Get Firewall options.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/options
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Set Firewall options.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/options
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

}